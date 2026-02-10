<div class="table-responsive">
    <table class="table" id="sedes-table">
        <thead>
        <tr>
            <th>Razon Social</th>
        <th>Telefono</th>
        <th>Direccion</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sedes as $sede)
            <tr>
                <td>{{ $sede->razon_social }}</td>
            <td>{{ $sede->telefono }}</td>
            <td>{{ $sede->direccion }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['sedes.destroy', $sede->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sedes.show', [$sede->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('sedes.edit', [$sede->id]) }}"
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
