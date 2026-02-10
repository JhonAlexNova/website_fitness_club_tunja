<div class="table-responsive">
    <table class="table" id="metodoPagos-table">
        <thead>
        <tr>
            <th>Tipo</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($metodoPagos as $metodoPago)
            <tr>
                <td>{{ $metodoPago->tipo }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['metodoPagos.destroy', $metodoPago->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('metodoPagos.show', [$metodoPago->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('metodoPagos.edit', [$metodoPago->id]) }}"
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
