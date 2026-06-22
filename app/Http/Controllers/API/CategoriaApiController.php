<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaApiController extends AppBaseController
{
    /**
     * Retorna todas las categorías principales con sus subcategorías anidadas.
     * Estructura: [ { id, nombre, descripcion, icono, subcategorias: [...] } ]
     */
    public function index()
    {
        $categorias = Categoria::with(['subcategorias'])
            ->whereNull('parent_id')
            ->orderBy('nombre', 'ASC')
            ->get()
            ->map(function ($cat) {
                return [
                    'id'            => $cat->id,
                    'nombre'        => $cat->nombre,
                    'descripcion'   => $cat->descripcion,
                    'icono'         => $cat->icono,
                    'subcategorias' => $cat->subcategorias->map(function ($sub) {
                        return [
                            'id'          => $sub->id,
                            'nombre'      => $sub->nombre,
                            'descripcion' => $sub->descripcion,
                            'icono'       => $sub->icono,
                        ];
                    })->values(),
                ];
            });

        return response()->json($categorias);
    }
}