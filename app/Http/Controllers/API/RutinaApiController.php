<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use Illuminate\Http\Request;

class RutinaApiController extends Controller
{
    public function rutinasGenerales()
    {
        $rutinas = Rutina::where('es_general', true)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($rutinas);
    }

    public function rutinasUsuario()
    {
        $rutinas = Rutina::where('user_id', auth()->id())
            ->where('es_general', false)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($rutinas);
    }

    public function ejericiosRutina($id)
    {
        $ejercicios = RutinaEjercicio::with(['ejercicio.musculos'])
            ->where('id_rutina', $id)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($ejercicios);
    }

    public function storeRutinaUsuario(Request $request)
    {
        $request->validate([
            'nombre_rutina'                  => 'required|string|max:100',
            'descripcion'                    => 'nullable|string',
            'duracion_semanas'               => 'nullable|integer',
            'ejercicios'                     => 'required|array|min:1',
            'ejercicios.*.id_ejercicio'      => 'required|exists:ejercicios,id',
            'ejercicios.*.series'            => 'nullable|integer',
            'ejercicios.*.repeticiones'      => 'nullable|integer',
            'ejercicios.*.descanso_segundos' => 'nullable|integer',
        ]);

        $rutina = Rutina::create([
            'nombre_rutina'    => $request->nombre_rutina,
            'descripcion'      => $request->descripcion,
            'user_id'          => auth()->id(),
            'es_general'       => false,
            'duracion_semanas' => $request->duracion_semanas ?? null,
        ]);

        foreach ($request->ejercicios as $ej) {
            RutinaEjercicio::create([
                'id_rutina'         => $rutina->id,
                'id_ejercicio'      => $ej['id_ejercicio'],
                'series'            => $ej['series'] ?? null,
                'repeticiones'      => $ej['repeticiones'] ?? null,
                'descanso_segundos' => $ej['descanso_segundos'] ?? null,
            ]);
        }

        return response()->json([
            'message' => 'Rutina creada correctamente',
            'rutina'  => $rutina
        ], 201);
    }

    /**
     * Actualizar nombre y/o descripción de una rutina propia del usuario.
     * Solo puede editar sus propias rutinas (user_id = auth).
     */
    public function update(Request $request, $id)
    {
        $rutina = Rutina::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('es_general', false)
            ->whereNull('deleted_at')
            ->firstOrFail();

        $request->validate([
            'nombre_rutina' => 'sometimes|required|string|max:100',
            'descripcion'   => 'nullable|string',
        ]);

        $rutina->update($request->only(['nombre_rutina', 'descripcion']));

        return response()->json([
            'message' => 'Rutina actualizada correctamente',
            'rutina'  => $rutina
        ]);
    }
}