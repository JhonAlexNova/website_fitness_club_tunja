<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\CoffeeCategory;
use Illuminate\Http\Request;

class CoffeeShopController extends Controller
{
    /**
     * Muestra el catálogo de productos de la cafetería en el sitio público,
     * agrupados por categoría. Solo informativo, sin carrito ni compra
     * (igual que el resto del sitio).
     */
    public function index()
    {
        $categorias = CoffeeCategory::with(['coffeeProducts' => function ($query) {
                $query->orderBy('nombre');
            }])
            ->where('activo', true)
            ->orderBy('orden')
            ->get();

        return view('website.cafeteria.index', compact('categorias'));
    }
}