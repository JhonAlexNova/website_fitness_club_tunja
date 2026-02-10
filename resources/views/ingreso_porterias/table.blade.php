<div class="table-responsive">
    <table class="table" id="ingresoPorterias-table">
        <thead>
        <tr>
            <th>Cliente Id</th>
        <th>Manilla Id</th>
        <th>Valor</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingresoPorterias as $ingresoPorteria)
            <tr>
                <td>{{ $ingresoPorteria->cliente_id }}</td>
            <td>{{ $ingresoPorteria->manilla_id }}</td>
            <td>{{ $ingresoPorteria->valor }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['ingresoPorterias.destroy', $ingresoPorteria->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ingresoPorterias.show', [$ingresoPorteria->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('ingresoPorterias.edit', [$ingresoPorteria->id]) }}"
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
