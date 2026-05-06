<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\RutinaDiariaElite;

class RutinaDiariaEliteController extends Controller
{
    public function index()
    {
        $inicio = now()->startOfWeek(1); // Lunes
        $fin    = now()->endOfWeek(6);   // Sábado

        $rutinas = RutinaDiariaElite::whereBetween('fecha', [$inicio, $fin])
            ->orderBy('fecha')
            ->get()
            ->map(fn($r) => [
                'id'          => $r->id,
                'titulo'      => $r->titulo,
                'descripcion' => $r->descripcion,
                'dia_semana'  => $r->dia_semana,
                'fecha'       => $r->fecha->format('d/m/Y'),
                'video_url'   => $r->getRawOriginal('video_url')
                                    ? asset('storage/' . $r->getRawOriginal('video_url'))
                                    : null,
            ]);

        return response()->json($rutinas);
    }
}