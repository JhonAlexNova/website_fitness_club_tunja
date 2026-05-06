<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;

class EjercicioApiController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::with('musculos')
            ->get(['id', 'nombre_ejercicio', 'descripcion', 'musculo_objetivo', 'equipo', 'nivel_dificultad', 'video_url'])
            ->map(function ($e) {
                return [
                    'id'                => $e->id,
                    'nombre_ejercicio'  => $e->nombre_ejercicio,
                    'descripcion'       => $e->descripcion,
                    'musculo_objetivo'  => $e->musculo_objetivo,
                    'equipo'            => $e->equipo,
                    'nivel_dificultad'  => $e->nivel_dificultad,
                    'video_url'         => $e->video_url
                        ? url('storage/' . $e->video_url)
                        : null,
                    'musculos'          => $e->musculos->map(fn($m) => [
                        'id'          => $m->id,
                        'nombre'      => $m->nombre,
                        'es_principal'=> (bool) $m->pivot->es_principal,
                    ]),
                ];
            });

        return response()->json($ejercicios);
    }

    public function show($id)
    {
        $ejercicio = Ejercicio::with('musculos')->find($id);

        if (!$ejercicio) {
            return response()->json(['message' => 'Ejercicio no encontrado'], 404);
        }

        return response()->json([
            'id'               => $ejercicio->id,
            'nombre_ejercicio' => $ejercicio->nombre_ejercicio,
            'descripcion'      => $ejercicio->descripcion,
            'musculo_objetivo' => $ejercicio->musculo_objetivo,
            'equipo'           => $ejercicio->equipo,
            'nivel_dificultad' => $ejercicio->nivel_dificultad,
            'video_url'        => $ejercicio->video_url
                ? url('storage/' . $ejercicio->video_url)
                : null,
            'musculos'         => $ejercicio->musculos->map(fn($m) => [
                'id'           => $m->id,
                'nombre'       => $m->nombre,
                'es_principal' => (bool) $m->pivot->es_principal,
            ]),
        ]);
    }
}