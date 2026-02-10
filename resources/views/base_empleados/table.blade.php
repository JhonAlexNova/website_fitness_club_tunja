<div class="">
    <table class="table datatableSimple" id="baseEmpleados-table">
        <thead>
        <tr>
            <th>Empleado</th>
            <th>Valor</th>
            <th >Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($baseEmpleados as $baseEmpleado)
            <tr>
                <td>{{ $baseEmpleado->empleado->primer_nombre }}  {{ $baseEmpleado->empleado->primer_apellido }} {{ $baseEmpleado->empleado->segundo_apellido }} </td>
               <td>{{ $baseEmpleado->valor }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['baseEmpleados.destroy', $baseEmpleado->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('baseEmpleados.show', [$baseEmpleado->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('baseEmpleados.edit', [$baseEmpleado->id]) }}"
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
