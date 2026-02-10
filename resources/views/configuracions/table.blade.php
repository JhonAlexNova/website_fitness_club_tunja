<div class="table-responsive">
    <table class="table" id="configuracions-table">
        <thead>
        <tr>
            <th>Logo</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Celular</th>
        <th>Correo</th>
        <th>Nit</th>
        <th>Razon Social</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($configuracions as $configuracion)
            <tr>
                <td>{{ $configuracion->logo }}</td>
            <td>{{ $configuracion->direccion }}</td>
            <td>{{ $configuracion->telefono }}</td>
            <td>{{ $configuracion->celular }}</td>
            <td>{{ $configuracion->correo }}</td>
            <td>{{ $configuracion->nit }}</td>
            <td>{{ $configuracion->razon_social }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['configuracions.destroy', $configuracion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('configuracions.show', [$configuracion->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('configuracions.edit', [$configuracion->id]) }}"
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
