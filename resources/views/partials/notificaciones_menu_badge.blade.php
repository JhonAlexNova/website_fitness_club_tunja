{{--
    Uso: @include('partials.notificaciones_menu_badge', ['tabla' => 'facturas', 'tipos' => ['factura_tienda']])
    - tabla: 'facturas' o 'pagos'
    - tipos (opcional): filtra por tipo exacto guardado en la notificación
      ej: ['factura_tienda'], ['factura_membresia'], ['wompi_webhook']
--}}
@php
    $conteoMenu = \App\Services\NotificacionAdminService::contarNoLeidas($tabla ?? null, $tipos ?? null);
@endphp

@if($conteoMenu > 0)
    <span class="badge badge-danger right">{{ $conteoMenu > 9 ? '9+' : $conteoMenu }}</span>
@endif