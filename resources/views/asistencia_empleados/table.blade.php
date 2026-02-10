<div class="table-responsive">
    <table class="table" id="asistenciaEmpleados-table">
        <thead>
        <tr>
            <th>#</th>
            <th>Empleado</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($asistenciaEmpleados as $index => $asistenciaEmpleado)
            <tr>
                <td> {{ $index+=1 }} </td>
                <td>{{ $asistenciaEmpleado->empleado->primer_nombre }}
                    {{ $asistenciaEmpleado->empleado->segundo_nombre }}
                    {{ $asistenciaEmpleado->empleado->primer_apellido }}
                    {{ $asistenciaEmpleado->empleado->segundo_apellido }}
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['asistenciaEmpleados.destroy', $asistenciaEmpleado->id], 'method' => 'delete']) !!}
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
