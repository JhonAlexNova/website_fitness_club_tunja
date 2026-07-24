<?php

namespace App\Http\Controllers;

use App\Models\CoffeeCategory;
use Illuminate\Http\Request;

class CoffeeCategoryController extends Controller
{
    public function index()
    {
        $coffee_categories = CoffeeCategory::orderBy('orden')->get();
        return view('coffee_categories.index', compact('coffee_categories'));
    }

    public function create()
    {
        return view('coffee_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'orden' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        CoffeeCategory::create($data);

        return redirect()->route('coffee-categories.index')
            ->with('success', 'Categoría creada correctamente');
    }

    public function show(CoffeeCategory $coffeeCategory)
    {
        //
    }

    public function edit($id)
    {
        $coffee_category = CoffeeCategory::findOrFail($id);
        return view('coffee_categories.edit', compact('coffee_category'));
    }

    public function update(Request $request, $id)
    {
        $category = CoffeeCategory::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'orden' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        $category->update($data);

        return redirect()->route('coffee-categories.index')
            ->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy($id)
    {
        $category = CoffeeCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('coffee-categories.index')
            ->with('success', 'Categoría eliminada correctamente');
    }

    /**
     * API: categorías con sus productos anidados (para app y website)
     */
    public function apiIndex()
    {
        $categorias = CoffeeCategory::with(['coffeeProducts' => function ($query) {
                $query->orderBy('nombre');
            }])
            ->where('activo', true)
            ->orderBy('orden')
            ->get();

        return response()->json($categorias);
    }
}