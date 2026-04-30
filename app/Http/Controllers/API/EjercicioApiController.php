<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;

class EjercicioApiController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::with('musculos')
            ->get(['id', 'nombre_ejercicio', 'descripcion', 'musculo_objetivo', 'equipo', 'nivel_dificultad', 'video_url']);

        dd($ejercicios->first()->toArray()); // temporal
            return response()->json($ejercicios);
    }

    public function show($id)
    {
        $ejercicio = Ejercicio::with('musculos')->find($id);

        if (!$ejercicio) {
            return response()->json(['message' => 'Ejercicio no encontrado'], 404);
        }

        return response()->json($ejercicio);
    }
}