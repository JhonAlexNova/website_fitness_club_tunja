<div class="table-responsiv">
    <table class="table datatableSimple" id="pagos-table">
        <thead>
        <tr>
            <th>Metodo de pago</th>
             <th>Valor</th>
             <th>Fecha</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pagos as $pago)
            <tr>
                <td>{{ $pago->metodo_pago->tipo }}</td>
                <td>${{ number_format($pago->valor) }}</td>
                <td> {{ $pago->created_at }} </td>
                    <td width="120">
                        {!! Form::open(['route' => ['pagos.destroy', $pago->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                        
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
