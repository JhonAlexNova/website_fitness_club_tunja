<div class="table-responsive">
    <table class="table datatableSimple" id="clientes-table">
        <thead>
        <tr>
            <th>Foto Perfil</th>
            <th>Primer Nombre</th>
            <th>Segundo Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Fecha Inscripción</th>
            <th>Talla</th>
            <th>Correo</th>
            <th>Documento</th>
            <th>Celular</th>
            <th>Perímetro Abdominal</th>
            <th>% Grasa</th>
            <th>% Músculo</th>
            <th>Estado</th>
            <th>Código Invitación</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr>
                <td>
                    <img
                        src="{{ !is_null($cliente->foto_perfil) ? url('storage', $cliente->foto_perfil) : url('img/avatar.png') }}"
                        style="width:50px"
                        alt="">
                </td>
                <td>{{ $cliente->primer_nombre }}</td>
                <td>{{ $cliente->segundo_nombre }}</td>
                <td>{{ $cliente->primer_apellido }}</td>
                <td>{{ $cliente->segundo_apellido }}</td>
                <td>{{ $cliente->fecha_inscripcion }}</td>
                <td>{{ $cliente->talla }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ $cliente->documento }}</td>
                <td>{{ $cliente->celular }}</td>
                <td>{{ $cliente->perimetro_abdominal }}</td>
                <td>{{ $cliente->porcentaje_grasa }}</td>
                <td>{{ $cliente->porcentaje_musculo }}</td>
                <td>{{ $cliente->estado }}</td>
                <td data-codigo="{{ $cliente->codigo_invitacion ?? '' }}">
                    @if($cliente->codigo_invitacion)
                        <span class="badge badge-info">{{ $cliente->codigo_invitacion }}</span>
                    @else
                        {{-- El guión exacto que el filtro JS busca para excluir --}}
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['clientes.destroy', $cliente->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('clientes.edit', [$cliente->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                            'type'    => 'submit',
                            'class'   => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('¿Eliminar este cliente?')"
                        ]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>