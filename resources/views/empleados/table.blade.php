<div class="">
    <table class="table datatableSimple" id="empleados-table" style='width:100%'>
        <thead>
        <tr>
            <th>Foto Perfil</th>
            <th>Username</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Celular</th>
            <th>Estado</th>
            <th>Email</th>
            <th>Documento</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($empleados as $empleado)
            <tr>
                <td>
                    <img class='avatar-profile-table' src="{{ url('storage/',$empleado->foto_perfil) }}" alt="">
                </td>
                <td>{{ $empleado->username }}</td>
                <td>{{ $empleado->primer_nombre }} {{ $empleado->segundo_nombre }} </td>
                <td>{{ $empleado->primer_apellido }} {{ $empleado->segundo_apellido }}</td>
                <td>{{ $empleado->celular }}</td>
                <td>{{ $empleado->estado }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->documento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['empleados.destroy', $empleado->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('empleados.edit', [$empleado->id]) }}"
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
