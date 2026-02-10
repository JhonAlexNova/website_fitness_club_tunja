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
        @foreach($administradores as $administrador)
            <tr>
                <td>
                    <img class='avatar-profile-table' src="{{ url('storage/',$administrador->foto_perfil) }}" alt="">
                </td>
                <td>{{ $administrador->username }}</td>
                <td>{{ $administrador->primer_nombre }} {{ $administrador->segundo_nombre }} </td>
                <td>{{ $administrador->primer_apellido }} {{ $administrador->segundo_apellido }}</td>
                <td>{{ $administrador->celular }}</td>
                <td>{{ $administrador->estado }}</td>
                <td>{{ $administrador->email }}</td>
                <td>{{ $administrador->documento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['administradores.destroy', $administrador->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('administradores.edit', [$administrador->id]) }}"
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
