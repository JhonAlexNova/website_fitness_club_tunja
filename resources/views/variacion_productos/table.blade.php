<div class="table-responsive">
    <table class="table" id="variacionProductos-table">
        <thead>
        <tr>
            <th>Producto Id</th>
        <th>Valor Caracteristica Id</th>
        <th>Precio</th>
        <th>Stock</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($variacionProductos as $variacionProducto)
            <tr>
                <td>{{ $variacionProducto->producto_id }}</td>
            <td>{{ $variacionProducto->valor_caracteristica_id }}</td>
            <td>{{ $variacionProducto->precio }}</td>
            <td>{{ $variacionProducto->stock }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['variacionProductos.destroy', $variacionProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('variacionProductos.show', [$variacionProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('variacionProductos.edit', [$variacionProducto->id]) }}"
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
