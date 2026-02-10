<div class="table-responsiv">
    <table class="table datatableSimple" id="clientes-table">
        <thead>
        <tr>
            <th>Foto Perfil</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha Inscripcion</th>
            <th>Talla</th>
            <th>Correo</th>
            <th>Perimetro Abdominal</th>
            <th>Porcentaje Grasa</th>
            <th>Porcentaje Musculo</th>
            <th>Celular</th>
            <th>Estado</th>
            <th>Correo</th>
            <th>Documento</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>
                     <img src="{{!is_null($cliente->foto_perfil)?url('storage',$cliente->foto_perfil):url('img/avatar.png')}}" style="width:50px" alt="">
                </td>
                <td>{{ $cliente->primer_nombre }}</td>
                <td>{{ $cliente->segundo_nombre }}</td>
                <td>{{ $cliente->primer_apellido }}</td>
                <td>{{ $cliente->segundo_apellido }}</td>
                 <td>{{ $cliente->fecha_inscripcion }}</td>
                <td>{{ $cliente->talla }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>{{ $cliente->perimetro_abdominal }}</td>
                <td>{{ $cliente->porcentaje_grasa }}</td>
                <td>{{ $cliente->porcentaje_musculo }}</td>
                <td>{{ $cliente->celular }}</td>
                <td>{{ $cliente->estado }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->documento }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <!-- <a href="{{ route('clientes.show', [$cliente->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> -->
                        <a href="{{ route('clientes.edit', [$cliente->id]) }}"
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
