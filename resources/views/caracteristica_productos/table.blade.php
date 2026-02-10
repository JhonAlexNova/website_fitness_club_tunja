<div class="table-responsive">
    <table class="table" id="caracteristicaProductos-table">
        <thead>
        <tr>
            <th>Producto Id</th>
        <th>Valor Caracteristica Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($caracteristicaProductos as $caracteristicaProducto)
            <tr>
                <td>{{ $caracteristicaProducto->producto_id }}</td>
            <td>{{ $caracteristicaProducto->valor_caracteristica_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['caracteristicaProductos.destroy', $caracteristicaProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('caracteristicaProductos.show', [$caracteristicaProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('caracteristicaProductos.edit', [$caracteristicaProducto->id]) }}"
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
