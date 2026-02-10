<div class="table-responsive">
    <table class="table" id="pagoMembresias-table">
        <thead>
        <tr>
            <th>User Membresia Id</th>
        <th>Monto</th>
        <th>Fecha Pago</th>
        <th>Metodo Pago</th>
        <th>Estado</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pagoMembresias as $pagoMembresia)
            <tr>
                <td>{{ $pagoMembresia->user_membresia_id }}</td>
            <td>{{ $pagoMembresia->monto }}</td>
            <td>{{ $pagoMembresia->fecha_pago }}</td>
            <td>{{ $pagoMembresia->metodo_pago }}</td>
            <td>{{ $pagoMembresia->estado }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['pagoMembresias.destroy', $pagoMembresia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('pagoMembresias.show', [$pagoMembresia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('pagoMembresias.edit', [$pagoMembresia->id]) }}"
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
