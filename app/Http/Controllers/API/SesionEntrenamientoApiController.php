<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\SesionEntrenamiento;
use App\Models\SerieCompletada;
use App\Models\RutinaEjercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SesionEntrenamientoApiController extends AppBaseController
{
    /**
     * POST /rutinas/{id}/sesion/iniciar
     * Crea una nueva sesión de entrenamiento para la rutina.
     */
    public function iniciar($rutinaId)
    {
        $sesion = SesionEntrenamiento::create([
            'id_rutina'   => $rutinaId,
            'id_user'     => Auth::id(),
            'iniciada_at' => Carbon::now(),
        ]);

        return response()->json([
            'sesion_id'   => $sesion->id,
            'iniciada_at' => $sesion->iniciada_at,
        ], 201);
    }

    /**
     * POST /sesiones/{id}/finalizar
     * Cierra la sesión y calcula la duración.
     */
    public function finalizar($sesionId, Request $request)
    {
        $sesion = SesionEntrenamiento::where('id', $sesionId)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        $ahora = Carbon::now();
        $duracion = (int) $sesion->iniciada_at->diffInMinutes($ahora);

        $sesion->update([
            'finalizada_at'    => $ahora,
            'duracion_minutos' => $duracion,
            'notas'            => $request->notas ?? null,
        ]);

        // Resumen: total series completadas y ejercicios trabajados
        $totalSeries = $sesion->series()->where('completada', true)->count();
        $ejercicios  = $sesion->series()
            ->distinct('id_rutina_ejercicio')
            ->count('id_rutina_ejercicio');

        return response()->json([
            'duracion_minutos' => $duracion,
            'total_series'     => $totalSeries,
            'ejercicios'       => $ejercicios,
        ]);
    }

    /**
     * POST /sesiones/{id}/series
     * Registra una serie completada (o la desmarca si ya existía).
     *
     * Body: { id_rutina_ejercicio, numero_serie, repeticiones_realizadas, peso_utilizado }
     */
    public function marcarSerie($sesionId, Request $request)
    {
        $request->validate([
            'id_rutina_ejercicio'    => 'required|integer',
            'numero_serie'           => 'required|integer|min:1',
            'repeticiones_realizadas'=> 'nullable|integer|min:0',
            'peso_utilizado'         => 'nullable|numeric|min:0',
        ]);

        // Verificar que la sesión pertenece al usuario
        $sesion = SesionEntrenamiento::where('id', $sesionId)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        // Toggle: si ya existe la desmarca, si no la crea
        $existing = SerieCompletada::where([
            'id_sesion'           => $sesionId,
            'id_rutina_ejercicio' => $request->id_rutina_ejercicio,
            'numero_serie'        => $request->numero_serie,
        ])->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['completada' => false]);
        }

        SerieCompletada::create([
            'id_sesion'               => $sesionId,
            'id_rutina_ejercicio'     => $request->id_rutina_ejercicio,
            'numero_serie'            => $request->numero_serie,
            'repeticiones_realizadas' => $request->repeticiones_realizadas,
            'peso_utilizado'          => $request->peso_utilizado,
            'completada'              => true,
        ]);

        return response()->json(['completada' => true], 201);
    }

    /**
     * GET /rutinas/{id}/historial
     * Devuelve el historial de sesiones de una rutina para el usuario autenticado.
     */
    public function historial($rutinaId)
    {
        $sesiones = SesionEntrenamiento::with(['series.rutinaEjercicio.ejercicio'])
            ->where('id_rutina', $rutinaId)
            ->where('id_user', Auth::id())
            ->whereNotNull('finalizada_at')
            ->orderByDesc('iniciada_at')
            ->limit(10)
            ->get()
            ->map(function ($s) {
                return [
                    'id'               => $s->id,
                    'iniciada_at'      => $s->iniciada_at,
                    'finalizada_at'    => $s->finalizada_at,
                    'duracion_minutos' => $s->duracion_minutos,
                    'notas'            => $s->notas,
                    'total_series'     => $s->series->where('completada', true)->count(),
                    'ejercicios'       => $s->series->unique('id_rutina_ejercicio')->count(),
                ];
            });

        return response()->json($sesiones);
    }

    /**
     * PUT /rutinas/{rutinaId}/ejercicios/{rutinaEjercicioId}
     * Edita series, reps, peso, descanso o notas de un ejercicio en la rutina.
     */
    public function actualizarEjercicio($rutinaId, $rutinaEjercicioId, Request $request)
    {
        $re = RutinaEjercicio::where('id', $rutinaEjercicioId)
            ->where('id_rutina', $rutinaId)
            ->firstOrFail();

        $re->update($request->only([
            'series', 'repeticiones', 'descanso_segundos', 'peso', 'notas', 'orden'
        ]));

        return response()->json($re);
    }

    /**
     * DELETE /rutinas/{rutinaId}/ejercicios/{rutinaEjercicioId}
     * Elimina un ejercicio de la rutina.
     */
    public function eliminarEjercicio($rutinaId, $rutinaEjercicioId)
    {
        $re = RutinaEjercicio::where('id', $rutinaEjercicioId)
            ->where('id_rutina', $rutinaId)
            ->firstOrFail();

        $re->delete();

        return response()->json(['message' => 'Ejercicio eliminado de la rutina']);
    }

    /**
     * POST /rutinas/{rutinaId}/ejercicios
     * Agrega un ejercicio a una rutina existente.
     */
    public function agregarEjercicio($rutinaId, Request $request)
    {
        $request->validate([
            'id_ejercicio'     => 'required|integer|exists:ejercicios,id',
            'series'           => 'nullable|integer|min:1',
            'repeticiones'     => 'nullable|integer|min:1',
            'descanso_segundos'=> 'nullable|integer|min:0',
            'peso'             => 'nullable|numeric|min:0',
            'notas'            => 'nullable|string',
        ]);

        $maxOrden = RutinaEjercicio::where('id_rutina', $rutinaId)->max('orden') ?? 0;

        $re = RutinaEjercicio::create([
            'id_rutina'         => $rutinaId,
            'id_ejercicio'      => $request->id_ejercicio,
            'series'            => $request->series ?? 3,
            'repeticiones'      => $request->repeticiones ?? 10,
            'descanso_segundos' => $request->descanso_segundos ?? 60,
            'peso'              => $request->peso,
            'notas'             => $request->notas,
            'orden'             => $maxOrden + 1,
        ]);

        $re->load('ejercicio');

        return response()->json($re, 201);
    }
}