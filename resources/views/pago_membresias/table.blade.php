<div class="table-responsive">
    <table class="table table-bordered table-hover" id="pagoMembresias-table">
        <thead class="thead-dark">
            <tr>
                <th>Cliente</th>
                <th>Membresía</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Método</th>
                <th>Comprobante</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($pagoMembresias as $pago)
            <tr>
                <td>{{ $pago->user_membresia_id }}</td>
                <td>{{ $pago->membresia }}</td>
                <td>{{ $pago->monto }}</td>
                <td>{{ $pago->fecha_pago }}</td>
                <td>
                    <span class="badge badge-{{ $pago->metodo_pago === 'WOMPI' ? 'primary' : 'secondary' }}">
                        {{ $pago->metodo_pago }}
                    </span>
                </td>
                <td>
                    @if($pago->comprobante)
                        <a href="{{ asset('storage/' . $pago->comprobante) }}"
                           target="_blank" class="btn btn-info btn-xs">
                            <i class="far fa-image"></i> Ver
                        </a>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    @php
                        $colores = [
                            'APPROVED' => 'success',
                            'PENDING'  => 'warning',
                            'DECLINED' => 'danger',
                            'VOIDED'   => 'secondary',
                        ];
                        $color = $colores[$pago->estado] ?? 'light';
                    @endphp
                    <span class="badge badge-{{ $color }}">{{ $pago->estado }}</span>

                    @if($pago->metodo_pago === 'TRANSFER' && $pago->estado === 'PENDING')
                        <button class="btn btn-success btn-xs ml-1"
                                onclick="aprobarPago('{{ $pago->referencia }}')">
                            <i class="fas fa-check"></i> Aprobar
                        </button>
                        <button class="btn btn-danger btn-xs ml-1"
                                onclick="rechazarPago('{{ $pago->referencia }}')">
                            <i class="fas fa-times"></i> Rechazar
                        </button>
                    @endif
                </td>
                <td>
                    <a href="{{ route('pagoMembresias.show', [$pago->id]) }}"
                       class="btn btn-default btn-xs">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@push('scripts')
<script>
function aprobarPago(referencia) {
    if (!confirm('¿Aprobar este pago?')) return;
    cambiarEstado(referencia, 'APPROVED', 'Aprobado por administrador');
}

function rechazarPago(referencia) {
    const motivo = prompt('Motivo del rechazo:');
    if (!motivo) return;
    cambiarEstado(referencia, 'DECLINED', motivo);
}

function cambiarEstado(referencia, estado, comentario) {
    fetch('/facturas/cambiar-estado', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ referencia, estado, comentario })
    })
    .then(r => r.json())
    .then(data => {
        if (data.response) location.reload();
        else alert('Error al actualizar el estado');
    })
    .catch(() => alert('Error de conexión'));
}
</script>
@endpush