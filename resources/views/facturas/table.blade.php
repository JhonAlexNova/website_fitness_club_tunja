<?php
    // Notificaciones sin leer de facturas, indexadas por referencia_id (id de la factura)
    $notifsNoLeidas = \App\Models\Notificacion::admin()
        ->noLeidas()
        ->deTabla('facturas')
        ->pluck('id', 'referencia_id');
?>
<div class="table-responsive">
    <table class="table" id="facturas-table">
        <thead>
        <tr>
            <th>Referencia</th>
            <th>Tipo</th>
            <th>Tipo pago</th>
            <th>Valor</th>
            <th>Estado</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($facturas as $factura)
            <tr>
                <td>
                    {{ $factura->referencia }}
                    @if(isset($notifsNoLeidas[$factura->id]))
                        <span class="badge badge-danger ml-1">NUEVO</span>
                    @endif
                </td>
                <td>{{ $factura->tipo }}</td>
                <td>{{ $factura->tipo_pago }}</td>
                <td>{{ $factura->total }}</td>
                <td>
                    @php
                        $estado = strtoupper($factura->estado);
                        switch ($estado) {
                            case 'APPROVED':
                                $badge = 'success';
                                break;
                            case 'PENDING':
                                $badge = 'warning';
                                break;
                            case 'REJECTED':
                                $badge = 'danger';
                                break;
                            default:
                                $badge = 'secondary';
                        }
                    @endphp
                    <span class="badge bg-{{ $badge }}">{{ $estado }}</span>
                </td>
                <td>{{ $factura->user->primer_nombre }} {{ $factura->user->primer_apellido }}</td>
                <td>{{ $factura->created_at }}</td>
                <td>
                   <button class="btn btn-info btn-sm"
                            onclick='abrirModalFactura({!! htmlspecialchars(json_encode([
                                "referencia" => $factura->referencia,
                                "tipo" => $factura->tipo,
                                "tipo_pago" => $factura->tipo_pago,
                                "valor" => $factura->total,
                                "estado" => $factura->estado,
                                "cliente" => $factura->user->primer_nombre . " " . $factura->user->primer_apellido,
                                "fecha" => $factura->created_at,
                                "comprobante_url" => $factura->comprobante ?? null
                            ]), ENT_QUOTES, 'UTF-8') !!})'>
                        <i class="fas fa-eye"></i> Revisar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>