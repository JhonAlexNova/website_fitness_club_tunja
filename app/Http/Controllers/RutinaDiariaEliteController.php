<?php
// app/Http/Controllers/RutinaDiariaEliteController.php

namespace App\Http\Controllers;

use App\Models\RutinaDiariaElite;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RutinaDiariaEliteController extends Controller
{
    public function index(Request $request)
    {
        $query = RutinaDiariaElite::query();

        if ($request->filled('mes')) {
            $query->whereMonth('fecha', Carbon::parse($request->mes)->month)
                  ->whereYear('fecha', Carbon::parse($request->mes)->year);
        }

        if ($request->filled('dia')) {
            $query->where('dia_semana', $request->dia);
        }

        $rutinas = $query->orderBy('fecha')->get()->groupBy('dia_semana');

        $diasOrden = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

        return view('rutinas-diarias-elite.index', compact('rutinas', 'diasOrden'));
    }

    public function create()
    {
        $dias = RutinaDiariaElite::diasSemana();
        return view('rutinas-diarias-elite.create', compact('dias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'dia_semana'  => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado',
            'fecha'       => 'required|date',
            'video'       => 'nullable|mimetypes:video/mp4,video/avi,video/quicktime,video/webm|max:204800',
        ]);

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos-rutinas-elite', 'public');
        }

        RutinaDiariaElite::create([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'dia_semana'  => $request->dia_semana,
            'fecha'       => $request->fecha,
            'video_url'   => $videoPath,
        ]);

        return redirect()->route('admon.rutinas-diarias-elite.index')
                         ->with('success', 'Rutina diaria elite creada correctamente.');
    }

    public function edit(RutinaDiariaElite $rutinas_diarias_elite)
    {
        $dias = RutinaDiariaElite::diasSemana();
        return view('rutinas-diarias-elite.edit', [
            'rutina' => $rutinas_diarias_elite,
            'dias'   => $dias,
        ]);
    }

    public function update(Request $request, RutinaDiariaElite $rutinas_diarias_elite)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'dia_semana'  => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado',
            'fecha'       => 'required|date',
            'video'       => 'nullable|mimetypes:video/mp4,video/avi,video/quicktime,video/webm|max:204800',
        ]);

        if ($request->hasFile('video')) {
            if ($rutinas_diarias_elite->getRawOriginal('video_url')) {
                \Storage::disk('public')->delete($rutinas_diarias_elite->getRawOriginal('video_url'));
            }
            $rutinas_diarias_elite->video_url = $request->file('video')->store('videos-rutinas-elite', 'public');
        }

        $rutinas_diarias_elite->titulo      = $request->titulo;
        $rutinas_diarias_elite->descripcion = $request->descripcion;
        $rutinas_diarias_elite->dia_semana  = $request->dia_semana;
        $rutinas_diarias_elite->fecha       = $request->fecha;
        $rutinas_diarias_elite->save();

        return redirect()->route('admon.rutinas-diarias-elite.index')
                         ->with('success', 'Rutina actualizada correctamente.');
    }

    public function destroy(RutinaDiariaElite $rutinas_diarias_elite)
    {
        if ($rutinas_diarias_elite->getRawOriginal('video_url')) {
            \Storage::disk('public')->delete($rutinas_diarias_elite->getRawOriginal('video_url'));
        }
        $rutinas_diarias_elite->delete();

        return redirect()->route('admon.rutinas-diarias-elite.index')
                         ->with('success', 'Rutina eliminada.');
    }
}