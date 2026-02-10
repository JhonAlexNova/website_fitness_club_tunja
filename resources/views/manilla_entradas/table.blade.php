<div class="table-responsive">
    <table class="table" id="manillaEntradas-table">
        <thead>
        <tr>
            <th>Passaporte de entrada</th>
            <th>Total</th>
            <th>Empleado</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($manillaEntradas as $manilla)
            <tr>
                <td> {{ $manilla->created_at }} </td>
                <td> {{ number_format($manilla->precio_full) }}  </td>
                <td> {{ number_format($manilla->precio_reducido) }}  </td>
                <td width="120">
                    {!! Form::open(['route' => ['manillaEntradas.destroy', $manilla->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('manillaEntradas.edit', [$manilla->id]) }}"
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
