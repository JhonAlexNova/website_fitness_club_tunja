<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BuzonSugerencia;
use App\Services\NotificacionAdminService;
use Illuminate\Http\Request;

class BuzonSugerenciaApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipo'    => 'required|in:problema,sugerencia,recomendacion,pregunta',
            'mensaje' => 'required|string|max:2000',
        ]);

        $mensaje = BuzonSugerencia::create([
            'user_id' => $request->user()->id,
            'tipo'    => $request->tipo,
            'mensaje' => $request->mensaje,
            'estado'  => 'nuevo',
        ]);

        $tiposLabels = BuzonSugerencia::tipos();
        $tituloTipo  = $tiposLabels[$request->tipo] ?? 'Mensaje';

        NotificacionAdminService::crear(
            "Nuevo mensaje: {$tituloTipo}",
            trim($request->user()->primer_nombre . ' ' . $request->user()->primer_apellido),
            'buzon_sugerencia',
            'buzon_sugerencias',
            $mensaje->id,
            route('buzon-sugerencias.show', $mensaje->id)
        );

        return response()->json([
            'success' => true,
            'message' => 'Tu mensaje fue enviado correctamente',
            'data'    => $mensaje,
        ]);
    }

    public function misMensajes(Request $request)
    {
        $mensajes = BuzonSugerencia::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($mensajes);
    }
}