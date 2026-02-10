<div class="table-responsive">
    <table class="table" id="imagenProductos-table">
        <thead>
        <tr>
            <th>Producto Id</th>
        <th>Url</th>
        <th>Es Portada</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($imagenProductos as $imagenProducto)
            <tr>
                <td>{{ $imagenProducto->producto_id }}</td>
            <td>{{ $imagenProducto->url }}</td>
            <td>{{ $imagenProducto->es_portada }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['imagenProductos.destroy', $imagenProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('imagenProductos.show', [$imagenProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('imagenProductos.edit', [$imagenProducto->id]) }}"
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
