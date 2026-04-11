<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notificacion;

class NotificacionApiController extends Controller
{
    public function index(Request $request)
    {
        $notificaciones = Notificacion::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $noLeidas = $notificaciones->where('leida', false)->count();

        return response()->json([
            'notificaciones' => $notificaciones,
            'no_leidas'      => $noLeidas,
        ]);
    }

    public function marcarLeidas(Request $request)
    {
        Notificacion::where('user_id', $request->user()->id)
            ->where('leida', false)
            ->update(['leida' => true]);

        return response()->json(['response' => true]);
    }
}