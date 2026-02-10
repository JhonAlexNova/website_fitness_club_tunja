<div class="table-responsive">
    <table class="table" id="descuadres-table">
        <thead>
        <tr>
            <th>Producto Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($descuadres as $descuadre)
            <tr>
                <td>{{ $descuadre->producto_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['descuadres.destroy', $descuadre->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('descuadres.show', [$descuadre->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('descuadres.edit', [$descuadre->id]) }}"
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
