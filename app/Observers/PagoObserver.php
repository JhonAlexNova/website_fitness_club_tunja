<?php

namespace App\Observers;

use App\Models\Pago;
use App\Services\NotificacionAdminService;

class PagoObserver
{
    public function created(Pago $pago)
    {
        NotificacionAdminService::crear(
            titulo: 'Nuevo pago registrado en caja',
            mensaje: "Se registró un pago por \$" . number_format($pago->valor, 0, ',', '.'),
            tipo: 'pago',
            referenciaTabla: 'pagos',
            referenciaId: $pago->id,
            enlace: route('pagos.show', $pago->id)
        );
    }
}