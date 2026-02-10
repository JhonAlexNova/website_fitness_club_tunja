<div class="table-responsive">
    <table class="table" id="detalleFacturas-table">
        <thead>
        <tr>
            <th>Factura Id</th>
        <th>Precio Id</th>
        <th>Producto Id</th>
        <th>Cantidad</th>
        <th>Total</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detalleFacturas as $detalleFactura)
            <tr>
                <td>{{ $detalleFactura->factura_id }}</td>
            <td>{{ $detalleFactura->precio_id }}</td>
            <td>{{ $detalleFactura->producto_id }}</td>
            <td>{{ $detalleFactura->cantidad }}</td>
            <td>{{ $detalleFactura->total }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['detalleFacturas.destroy', $detalleFactura->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('detalleFacturas.show', [$detalleFactura->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('detalleFacturas.edit', [$detalleFactura->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
