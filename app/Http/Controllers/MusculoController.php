<?php

namespace App\Http\Controllers;

use App\Models\Musculo;
use Illuminate\Http\Request;
use Storage;

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

      

        
        
        if ($request->hasFile('file_imagen')) {
            $path = $request->file('file_imagen')->store('musculos', 'public');
            $request['imagen'] = $path;
        }


          Musculo::create($request->all());

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo creado correctamente');
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
        $musculo = Musculo::find($musculo->id);
        
        $request->validate([
            'nombre' => 'required|string|max:100|unique:musculos,nombre,' . $musculo->id
        ]);


        if ($request->hasFile('file_imagen')) {
            $path = Storage::disk('public')->put('musculos', $request->file('file_imagen'));
            $request['imagen'] = $path;
        }

         $musculo->update($request->all());

          
        return redirect()->route('musculos.index')
            ->with('success', 'Músculo actualizado correctamente');
    }

    public function destroy(Musculo $musculo)
    {
        $musculo->delete();

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo eliminado correctamente');
    }
}
