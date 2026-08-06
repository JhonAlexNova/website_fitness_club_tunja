<?php

namespace App\Http\Controllers;

use App\Models\BuzonSugerencia;
use Illuminate\Http\Request;

class BuzonSugerenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = BuzonSugerencia::with('usuario')->orderBy('created_at', 'desc');

        if ($request->filled('tipo')) {
            $query->where('tipo', $request->tipo);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $mensajes = $query->paginate(15);

        return view('buzon_sugerencias.index', compact('mensajes'));
    }

    public function show($id)
    {
        $mensaje = BuzonSugerencia::with('usuario')->findOrFail($id);

        if ($mensaje->estado === 'nuevo') {
            $mensaje->estado = 'leido';
            $mensaje->save();
        }

        return view('buzon_sugerencias.show', compact('mensaje'));
    }

    public function responder(Request $request, $id)
    {
        $request->validate([
            'respuesta' => 'required|string',
        ]);

        $mensaje = BuzonSugerencia::findOrFail($id);
        $mensaje->respuesta = $request->respuesta;
        $mensaje->estado = 'respondido';
        $mensaje->respondido_at = now();
        $mensaje->save();

        return redirect()->route('buzon-sugerencias.index')
            ->with('success', 'Respuesta enviada correctamente');
    }

    public function destroy($id)
    {
        BuzonSugerencia::findOrFail($id)->delete();

        return redirect()->route('buzon-sugerencias.index')
            ->with('success', 'Mensaje eliminado');
    }
}