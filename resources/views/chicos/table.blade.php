<div class="table-responsiv">
    <table class="table datatableSimple" id="chicos-table">
        <thead>
        <tr>
            <th>Empleado</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Fecha</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($chicos as $chico)
            <tr>
                <td>
                @if(isset($chico->empleado->primer_nombre))
                    {{ $chico->empleado->primer_nombre }}
                    {{ $chico->empleado->segundo_nombre }}
                    {{ $chico->empleado->primer_apellido }}
                    {{ $chico->empleado->segundo_apellido }}
                @else
                    Usuario eliminado
                @endif

                   
                </td>
                <td>{{ $chico->cantidad }}</td>
                <td>$ {{ number_format($chico->valor) }}</td>
                <td> {{$chico->created_at}} </td>
                <td width="120">
                    {!! Form::open(['route' => ['chicos.destroy', $chico->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                       
                        <!-- <a href="{{ route('chicos.edit', [$chico->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a> -->
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
