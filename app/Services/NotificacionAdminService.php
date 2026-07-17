<?php

namespace App\Services;

use App\Models\Notificacion;

class NotificacionAdminService
{
    /**
     * Crea una notificación visible en el panel de administración.
     *
     * @param string $titulo
     * @param string $mensaje
     * @param string $tipo             ej: 'pago', 'factura_membresia', 'factura_tienda', 'wompi_webhook'
     * @param string|null $referenciaTabla ej: 'facturas', 'pagos'
     * @param int|null $referenciaId
     * @param string|null $enlace      ruta ya resuelta, ej: route('facturas.show', $id)
     */
    public static function crear(
        string $titulo,
        string $mensaje,
        string $tipo,
        ?string $referenciaTabla = null,
        ?int $referenciaId = null,
        ?string $enlace = null
    ): Notificacion {
        return Notificacion::create([
            'titulo'           => $titulo,
            'mensaje'          => $mensaje,
            'tipo'             => $tipo,
            'referencia_tabla' => $referenciaTabla,
            'referencia_id'    => $referenciaId,
            'enlace'           => $enlace,
            'es_admin'         => true,
            'leida'            => false,
        ]);
    }

    /**
     * Cantidad de notificaciones sin leer para el panel admin.
     *
     * @param string|null $tabla 'facturas' | 'pagos'
     * @param array|null $tipos  ej: ['factura_tienda', 'wompi_webhook'] para filtrar por módulo exacto
     */
    public static function contarNoLeidas(?string $tabla = null, ?array $tipos = null): int
    {
        $query = Notificacion::admin()->noLeidas();

        if ($tabla) {
            $query->deTabla($tabla);
        }

        if ($tipos) {
            $query->whereIn('tipo', $tipos);
        }

        return $query->count();
    }

    /**
     * Marca como leídas todas las notificaciones de una tabla (o todas si no se especifica).
     */
    public static function marcarLeidas(?string $tabla = null): void
    {
        $query = Notificacion::admin()->noLeidas();

        if ($tabla) {
            $query->deTabla($tabla);
        }

        $query->update(['leida' => true]);
    }
}