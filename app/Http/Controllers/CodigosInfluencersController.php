<?php

namespace App\Http\Controllers;

use App\Models\CodigoPromocional;
use Illuminate\Http\Request;
use Flash;

class CodigosInfluencersController extends AppBaseController
{
    public function index()
    {
        $codigos = CodigoPromocional::latest()->get();
        return view('codigos_influencers.index', compact('codigos'));
    }

    public function create()
    {
        return view('codigos_influencers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo'           => 'required|string|max:100|unique:codigos_promocionales,codigo',
            'creador'          => 'nullable|string|max:255',
            'activo'           => 'nullable',   // ← quitar |boolean
            'max_usos'         => 'nullable|integer|min:1',
            'fecha_expiracion' => 'nullable|date|after:today',
        ]);

        CodigoPromocional::create([
            'codigo'           => strtoupper(trim($request->codigo)),
            'creador'          => $request->creador,
            'activo'           => $request->has('activo') ? 1 : 0,
            'max_usos'         => $request->max_usos ?? null,
            'fecha_expiracion' => $request->fecha_expiracion ?? null,
        ]);

        Flash::success('Código creado correctamente.');
        return redirect(route('codigos-influencers.index'));
    }

    public function edit($id)
    {
        $codigo = CodigoPromocional::find($id);

        if (empty($codigo)) {
            Flash::error('Código no encontrado.');
            return redirect(route('codigos-influencers.index'));
        }

        return view('codigos_influencers.edit', compact('codigo'));
    }

    public function update(Request $request, $id)
    {
        $codigo = CodigoPromocional::find($id);

        if (empty($codigo)) {
            Flash::error('Código no encontrado.');
            return redirect(route('codigos-influencers.index'));
        }

        $request->validate([
            'codigo'           => 'required|string|max:100|unique:codigos_promocionales,codigo,' . $id,
            'creador'          => 'nullable|string|max:255',
            'activo'           => 'nullable',   // ← quitar |boolean
            'max_usos'         => 'nullable|integer|min:1',
            'fecha_expiracion' => 'nullable|date',
        ]);

        $codigo->codigo           = strtoupper(trim($request->codigo));
        $codigo->creador          = $request->creador;
        $codigo->activo           = $request->has('activo') ? 1 : 0;
        $codigo->max_usos         = $request->max_usos ?? null;
        $codigo->fecha_expiracion = $request->fecha_expiracion ?? null;
        $codigo->save();

        Flash::success('Código actualizado correctamente.');
        return redirect(route('codigos-influencers.index'));
    }

    public function destroy($id)
    {
        $codigo = CodigoPromocional::find($id);

        if (empty($codigo)) {
            Flash::error('Código no encontrado.');
            return redirect(route('codigos-influencers.index'));
        }

        $codigo->delete();

        Flash::success('Código eliminado correctamente.');
        return redirect(route('codigos-influencers.index'));
    }
}