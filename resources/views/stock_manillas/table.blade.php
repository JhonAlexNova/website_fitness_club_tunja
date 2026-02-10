<div class="table-responsive">
    <table class="table" id="stockManillas-table">
        <thead>
        <tr>
            <th>Manilla Id</th>
        <th>Cantidad Actual</th>
        <th>Cantidad Anterior</th>
        <th>Cantidad</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($stockManillas as $stockManilla)
            <tr>
                <td>{{ $stockManilla->manilla_id }}</td>
            <td>{{ $stockManilla->cantidad_actual }}</td>
            <td>{{ $stockManilla->cantidad_anterior }}</td>
            <td>{{ $stockManilla->cantidad }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['stockManillas.destroy', $stockManilla->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('stockManillas.show', [$stockManilla->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('stockManillas.edit', [$stockManilla->id]) }}"
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
