{{--
    Uso: @include('partials.notificaciones_badge', ['tabla' => 'facturas'])
    Pasa 'tabla' = 'facturas' o 'pagos' según el listado donde lo incluyas.
    Al cargar la vista, marca como leídas las notificaciones de esa tabla.
--}}
@php
    $noLeidas = \App\Services\NotificacionAdminService::contarNoLeidas($tabla ?? null);
@endphp

@if($noLeidas > 0)
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-bell"></i>
            <strong>{{ $noLeidas }}</strong>
            {{ $noLeidas === 1 ? 'pago nuevo sin revisar' : 'pagos nuevos sin revisar' }}
        </div>
        <button type="button" class="btn btn-sm btn-outline-dark"
                onclick="marcarNotificacionesLeidas('{{ $tabla ?? '' }}', this)">
            Marcar como visto
        </button>
    </div>
@endif

@push('scripts')
<script>
function marcarNotificacionesLeidas(tabla, btn) {
    fetch('{{ route("notificaciones.marcarLeidas") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ tabla })
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.closest('.alert').remove();
        }
    })
    .catch(() => alert('Error de conexión'));
}
</script>
@endpush