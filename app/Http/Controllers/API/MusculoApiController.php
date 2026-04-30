<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Musculo;

class MusculoApiController extends Controller
{
    public function index()
    {
        $musculos = Musculo::orderBy('nombre')->get()->map(function ($m) {
            return [
                'id'        => $m->id,
                'nombre'    => $m->nombre,
                'categoria' => $m->categoria,
                'imagen'    => $m->imagen
                    ? url('storage/' . $m->imagen)
                    : null,
            ];
        });

        $grouped = [
            'cuerpo_superior' => $musculos->where('categoria', 'cuerpo_superior')->values(),
            'cuerpo_inferior' => $musculos->where('categoria', 'cuerpo_inferior')->values(),
        ];

        return response()->json($grouped);
    }
}