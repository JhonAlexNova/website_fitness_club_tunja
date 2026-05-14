<div class="table-responsive">
    <table class="table datatableSimple" id="codigos-table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Creador</th>
                <th>Estado</th>
                <th>Usos</th>
                <th>Máx. Usos</th>
                <th>Expira</th>
                <th>Creado</th>
                <th width="120">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($codigos as $codigo)
                <tr>
                    <td>
                        <strong class="text-primary">{{ $codigo->codigo }}</strong>
                    </td>
                    <td>{{ $codigo->creador ?? '—' }}</td>
                    <td>
                        @if($codigo->activo)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>{{ $codigo->usos }}</td>
                    <td>{{ $codigo->max_usos ?? '∞' }}</td>
                    <td>
                        @if($codigo->fecha_expiracion)
                            {{ \Carbon\Carbon::parse($codigo->fecha_expiracion)->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Sin expiración</span>
                        @endif
                    </td>
                    <td>{{ $codigo->created_at->format('d/m/Y') }}</td>
                    <td>
                        {!! Form::open(['route' => ['codigos-influencers.destroy', $codigo->id], 'method' => 'delete']) !!}
                        <div class="btn-group">
                            <a href="{{ route('codigos-influencers.edit', $codigo->id) }}"
                               class="btn btn-default btn-xs">
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type'    => 'submit',
                                'class'   => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('¿Eliminar este código?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>