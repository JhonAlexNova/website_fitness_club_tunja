<div class="table-responsive">
    <table class="table" id="trasladoProductos-table">
        <thead>
        <tr>
            <th>Negocio Origen Id</th>
        <th>Negocio Destino Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trasladoProductos as $trasladoProducto)
            <tr>
                <td>{{ $trasladoProducto->negocio_origen_id }}</td>
            <td>{{ $trasladoProducto->negocio_destino_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['trasladoProductos.destroy', $trasladoProducto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('trasladoProductos.show', [$trasladoProducto->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('trasladoProductos.edit', [$trasladoProducto->id]) }}"
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
