<?php

namespace App\Http\Controllers;

use App\Models\Musculo;
use Illuminate\Http\Request;
use Storage;

class MusculoController extends Controller
{
    public function index()
    {
        $musculos = Musculo::orderBy('nombre')->get();
        return view('musculos.index', compact('musculos'));
    }

    public function create()
    {
        return view('musculos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:100|unique:musculos,nombre',
            'categoria' => 'required|in:cuerpo_superior,cuerpo_inferior',
            'file_modelo_3d' => 'nullable|file'
        ]);


        $data = $request->only(['nombre', 'categoria']);

        if ($request->hasFile('file_imagen')) {
            $data['imagen'] = $request->file('file_imagen')->store('musculos', 'public');
        }

        if ($request->hasFile('file_modelo_3d')) {
            $data['modelo_3d'] = $request->file('file_modelo_3d')->store('musculos-modelos3d', 'public');
        }

        Musculo::create($data);

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
        $request->validate([
            'nombre'    => 'required|string|max:100|unique:musculos,nombre,' . $musculo->id,
            'categoria' => 'required|in:cuerpo_superior,cuerpo_inferior',
        ]);

        $data = $request->only(['nombre', 'categoria']);

        if ($request->hasFile('file_imagen')) {
            if ($musculo->imagen && Storage::disk('public')->exists($musculo->imagen)) {
                Storage::disk('public')->delete($musculo->imagen);
            }
            $data['imagen'] = Storage::disk('public')->put('musculos', $request->file('file_imagen'));
        }

        if ($request->hasFile('file_modelo_3d')) {
            if ($musculo->modelo_3d && Storage::disk('public')->exists($musculo->modelo_3d)) {
                Storage::disk('public')->delete($musculo->modelo_3d);
            }
            $data['modelo_3d'] = Storage::disk('public')->put('musculos-modelos3d', $request->file('file_modelo_3d'));
        }

        $musculo->update($data);

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo actualizado correctamente');
    }

    public function destroy(Musculo $musculo)
    {
        if ($musculo->imagen && Storage::disk('public')->exists($musculo->imagen)) {
            Storage::disk('public')->delete($musculo->imagen);
        }

        $musculo->delete();

        return redirect()->route('musculos.index')
            ->with('success', 'Músculo eliminado correctamente');
    }
}