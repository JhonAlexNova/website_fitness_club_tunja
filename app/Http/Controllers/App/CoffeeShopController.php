<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\CoffeeProduct;

class CoffeeShopController extends Controller
{
    public function index()
    {
        $productos = CoffeeProduct::all();

        return view('app.coffee-shop.index', compact('productos'));
    }
}