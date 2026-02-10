<div class="table-responsive">
    <table class="table" id="detalleDevolucions-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Devolucion Id</th>
        <th>Producto Id</th>
        <th>Cantidad Unidades Devolucion</th>
        <th>Valor Unit De Cambio</th>
        <th>Total Devuelto</th>
        <th>Total Ganancia</th>
        <th>Createt At</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($detalleDevolucions as $detalleDevolucion)
            <tr>
                <td>{{ $detalleDevolucion->id }}</td>
            <td>{{ $detalleDevolucion->devolucion_id }}</td>
            <td>{{ $detalleDevolucion->producto_id }}</td>
            <td>{{ $detalleDevolucion->cantidad_unidades_devolucion }}</td>
            <td>{{ $detalleDevolucion->valor_unit_de_cambio }}</td>
            <td>{{ $detalleDevolucion->total_devuelto }}</td>
            <td>{{ $detalleDevolucion->total_ganancia }}</td>
            <td>{{ $detalleDevolucion->createt_at }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['detalleDevolucions.destroy', $detalleDevolucion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('detalleDevolucions.show', [$detalleDevolucion->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('detalleDevolucions.edit', [$detalleDevolucion->id]) }}"
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
