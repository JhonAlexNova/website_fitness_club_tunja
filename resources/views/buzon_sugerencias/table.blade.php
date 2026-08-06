<div class="table-responsive">
    <table class="table" id="buzon-table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Mensaje</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th width="100">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mensajes as $mensaje)
                <tr>
                    <td>{{ $mensaje->usuario ? trim($mensaje->usuario->primer_nombre.' '.$mensaje->usuario->primer_apellido) : '—' }}</td>
                    <td>
                        <span class="badge badge-info">{{ \App\Models\BuzonSugerencia::tipos()[$mensaje->tipo] ?? $mensaje->tipo }}</span>
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($mensaje->mensaje, 60) }}</td>
                    <td>
                        @if($mensaje->estado === 'nuevo')
                            <span class="badge badge-danger">Nuevo</span>
                        @elseif($mensaje->estado === 'leido')
                            <span class="badge badge-warning">Leído</span>
                        @else
                            <span class="badge badge-success">Respondido</span>
                        @endif
                    </td>
                    <td>{{ $mensaje->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        {!! Form::open(['route' => ['buzon-sugerencias.destroy', $mensaje->id], 'method' => 'delete']) !!}
                        <div class="btn-group">
                            <a href="{{ route('buzon-sugerencias.show', $mensaje->id) }}"
                               class="btn btn-default btn-xs">
                                <i class="far fa-eye"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type'    => 'submit',
                                'class'   => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('¿Eliminar este mensaje?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>