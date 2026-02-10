<div class="table-responsive">
    <table class="table" id="historialProductos-table">
        <thead>
        <tr>
            <th>Producto Id</th>
        <th>Cantidad</th>
        <th>Cantidad Anterior</th>
        <th>Cantidad Actual</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($historialProductos as $historialProducto)
            <tr>
                <td>{{ $historialProducto->producto_id }}</td>
            <td>{{ $historialProducto->cantidad }}</td>
            <td>{{ $historialProducto->cantidad_anterior }}</td>
            <td>{{ $historialProducto->cantidad_actual }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['historialProductos.destroy', $historialProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('historialProductos.show', [$historialProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('historialProductos.edit', [$historialProducto->id]) }}"
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
