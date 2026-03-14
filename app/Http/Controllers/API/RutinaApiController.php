<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rutina;
use App\Models\RutinaEjercicio;
use Illuminate\Http\Request;

class RutinaApiController extends Controller
{
    // Rutinas generales (es_general = true)
    public function rutinasGenerales()
    {
        $rutinas = Rutina::where('es_general', true)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($rutinas);
    }

    // Rutinas asignadas al usuario autenticado
    public function rutinasUsuario()
    {
        $rutinas = Rutina::where('user_id', auth()->id())
            ->where('es_general', false)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($rutinas);
    }

    // Ejercicios de una rutina específica
    public function ejericiosRutina($id)
    {
        $ejercicios = RutinaEjercicio::with('ejercicio')
            ->where('id_rutina', $id)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($ejercicios);
    }

    // Crear rutina personalizada por el usuario
    public function storeRutinaUsuario(Request $request)
    {
        $request->validate([
            'nombre_rutina'                       => 'required|string|max:100',
            'descripcion'                         => 'nullable|string',
            'duracion_semanas'                    => 'nullable|integer',
            'ejercicios'                          => 'required|array|min:1',
            'ejercicios.*.id_ejercicio'           => 'required|exists:ejercicios,id',
            'ejercicios.*.series'                 => 'nullable|integer',
            'ejercicios.*.repeticiones'           => 'nullable|integer',
            'ejercicios.*.descanso_segundos'      => 'nullable|integer',
        ]);

        // Crear la rutina
        $rutina = Rutina::create([
            'nombre_rutina'    => $request->nombre_rutina,
            'descripcion'      => $request->descripcion,
            'user_id'          => auth()->id(),
            'es_general'       => false,
            'duracion_semanas' => $request->duracion_semanas ?? null,
        ]);

        // Crear los ejercicios asociados
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
}