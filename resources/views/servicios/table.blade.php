<div class="table-responsive">
    <table class="table" id="servicios-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Valor</th>
            <th>Tipo</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($servicios as $servicio)
            <tr>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->valor }}</td>
                <td>{{ $servicio->tipo }}</td>  
                <td width="120">
                    {!! Form::open(['route' => ['servicios.destroy', $servicio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('servicios.show', [$servicio->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('servicios.edit', [$servicio->id]) }}"
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
