<div class="table-responsiv">
    <table class="table datatableSimple" id="gastos-table">
        <thead>
        <tr>
            <th>Concepto</th>
            <th>Valor</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($gastos as $gasto)
            <tr>
                <td>{{ $gasto->concepto }}</td>
                <td> ${{ number_format($gasto->valor) }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['gastos.destroy', $gasto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('gastos.edit', [$gasto->id]) }}"
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
