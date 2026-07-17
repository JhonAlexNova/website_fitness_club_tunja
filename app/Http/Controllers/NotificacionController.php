<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\NotificacionAdminService;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Marca como leídas las notificaciones de admin, opcionalmente filtradas por tabla.
     */
    public function marcarLeidas(Request $request)
    {
        $tabla = $request->input('tabla'); // 'facturas', 'pagos' o null (todas)

        NotificacionAdminService::marcarLeidas($tabla);

        return response()->json(['success' => true]);
    }
}