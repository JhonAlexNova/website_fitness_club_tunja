<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CodigoPromocional;
use Illuminate\Http\Request;

class CodigoPromocionalController extends Controller
{
    public function validar($codigo)
    {
        $codigo = CodigoPromocional::where(
            'codigo',
            strtoupper(trim($codigo))
        )->first();

        if (!$codigo) {
            return response()->json([
                'success' => false,
                'message' => 'Código no encontrado'
            ], 404);
        }

        if (!$codigo->esValido()) {
            return response()->json([
                'success' => false,
                'message' => 'El código no es válido'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Código válido',
            'data' => [
                'codigo' => $codigo->codigo,
                'creador' => $codigo->creador
            ]
        ]);
    }
}