<?php

namespace App\Http\Controllers;

use App\Models\Musculo;
use Illuminate\Http\Request;

class MusculoController extends Controller
{
    public function index()
    {
        $musculos = Musculo::orderBy('nombre')->paginate(15);
        return view('musculos.index', compact('musculos'));
    }

    public function create()
    {
        return view('musculos.create');
    }

    public function store(Request $request)
    {
        $request->validate(Musculo::$rules);

        Musculo::create($request->all());

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo creado correctamente');
        
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('musculos', 'public');
            $input['imagen'] = $path;
        }
    }

    public function show(Musculo $musculo)
    {
        return view('musculos.show', compact('musculo'));
    }

    public function edit(Musculo $musculo)
    {
        return view('musculos.edit', compact('musculo'));
    }

    public function update(Request $request, Musculo $musculo)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:musculos,nombre,' . $musculo->id
        ]);

        $musculo->update($request->all());

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo actualizado correctamente');

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('musculos', 'public');
            $input['imagen'] = $path;
        }
    }

    public function destroy(Musculo $musculo)
    {
        $musculo->delete();

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo eliminado correctamente');
    }
}
