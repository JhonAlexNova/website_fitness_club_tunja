<?php

namespace App\Http\Controllers;

use App\Models\CoffeeProduct;
use App\Models\CoffeeCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoffeeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coffee_products = CoffeeProduct::with('coffeeCategory')->get();
        return view('coffee_products.index', compact('coffee_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coffee_categories = CoffeeCategory::where('activo', true)->orderBy('orden')->get();
        return view('coffee_products.create', compact('coffee_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'coffee_category_id' => 'nullable|exists:coffee_categories,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:10000'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('coffee', 'public');
        }

        CoffeeProduct::create($data);

        return redirect()->route('coffee-products.index')
            ->with('success','Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CoffeeProduct  $coffeeProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CoffeeProduct $coffeeProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoffeeProduct  $coffeeProduct
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        $coffee_product = CoffeeProduct::findOrFail($id);
        $coffee_categories = CoffeeCategory::where('activo', true)->orderBy('orden')->get();
        return view('coffee_products.edit', compact('coffee_product', 'coffee_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoffeeProduct  $coffeeProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = CoffeeProduct::findOrFail($id);

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'coffee_category_id' => 'nullable|exists:coffee_categories,id',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png|max:10000'
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('coffee', 'public');
        }

        $product->update($data);

        return redirect()->route('coffee-products.index')
            ->with('success','Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoffeeProduct  $coffeeProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(CoffeeProduct $coffeeProduct)
    {
        $coffeeProduct->delete();

        return redirect()->route('coffee-products.index')
            ->with('success', 'Producto eliminado correctamente');
    }

    public function apiIndex()
    {
        $productos = CoffeeProduct::with('coffeeCategory')->get();

        return response()->json($productos);
    }
}