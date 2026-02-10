<div class="table-responsive">
    <table class="table" id="historialPrecioProductos-table">
        <thead>
        <tr>
            <th>Producto Id</th>
        <th>Precio</th>
        <th>Fecha Actualizacion</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($historialPrecioProductos as $historialPrecioProducto)
            <tr>
                <td>{{ $historialPrecioProducto->producto_id }}</td>
            <td>{{ $historialPrecioProducto->precio }}</td>
            <td>{{ $historialPrecioProducto->fecha_actualizacion }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['historialPrecioProductos.destroy', $historialPrecioProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('historialPrecioProductos.show', [$historialPrecioProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('historialPrecioProductos.edit', [$historialPrecioProducto->id]) }}"
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
