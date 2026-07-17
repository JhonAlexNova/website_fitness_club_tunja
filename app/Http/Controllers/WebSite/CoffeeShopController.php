<?php

namespace App\Http\Controllers\WebSite;

use App\Http\Controllers\Controller;
use App\Models\CoffeeProduct;
use Illuminate\Http\Request;

class CoffeeShopController extends Controller
{
    /**
     * Muestra el catálogo de productos de la cafetería en el sitio público.
     * Solo informativo, sin carrito ni compra (igual que el resto del sitio).
     */
    public function index()
    {
        $productos = CoffeeProduct::orderBy('nombre')->get();

        return view('website.cafeteria.index', compact('productos'));
    }
}