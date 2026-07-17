<?php

namespace App\Observers;

use App\Models\Factura;
use App\Services\NotificacionAdminService;

class FacturaObserver
{
    public function created(Factura $factura)
    {
        $cliente = optional($factura->user)->primer_nombre . ' ' . optional($factura->user)->primer_apellido;
        $metodo  = strtoupper($factura->tipo_pago ?? 'N/A');
        $tipo    = $factura->tipo === 'membresia' ? 'factura_membresia' : 'factura_tienda';

        NotificacionAdminService::crear(
            titulo: 'Nuevo pago recibido',
            mensaje: "Pago de {$cliente} por \${$this->formatoMonto($factura->total)} vía {$metodo} - Ref: {$factura->referencia}",
            tipo: $tipo,
            referenciaTabla: 'facturas',
            referenciaId: $factura->id,
            enlace: $factura->tipo === 'membresia'
                ? route('pagoMembresias.show', $factura->id)
                : route('transaccions.show', $factura->id)
        );
    }

    public function updated(Factura $factura)
    {
        // Si el estado cambió (ej: webhook de Wompi confirma o rechaza el pago)
        if ($factura->wasChanged('estado')) {
            $cliente = optional($factura->user)->primer_nombre . ' ' . optional($factura->user)->primer_apellido;

            $mensaje = match ($factura->estado) {
                'APPROVED' => "Pago APROBADO de {$cliente} - Ref: {$factura->referencia}",
                'REJECTED', 'DECLINED' => "Pago RECHAZADO de {$cliente} - Ref: {$factura->referencia}. Revisar.",
                default => "Estado de pago actualizado a {$factura->estado} para {$cliente} - Ref: {$factura->referencia}",
            };

            NotificacionAdminService::crear(
                titulo: 'Cambio de estado en pago',
                mensaje: $mensaje,
                tipo: 'wompi_webhook',
                referenciaTabla: 'facturas',
                referenciaId: $factura->id,
                enlace: $factura->tipo === 'membresia'
                    ? route('pagoMembresias.show', $factura->id)
                    : route('transaccions.show', $factura->id)
            );
        }
    }

    private function formatoMonto($valor): string
    {
        return number_format($valor, 0, ',', '.');
    }
}