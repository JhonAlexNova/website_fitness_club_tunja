<div class="">
    <table class="table datatableSimple" id="categorias-table">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Jerarquía</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>
                    @if($categoria->parent_id)
                        <span class="badge badge-info">
                            <i class="fa fa-level-down-alt"></i> Subcategoría
                        </span>
                    @else
                        <span class="badge badge-primary">
                            <i class="fa fa-folder"></i> Principal
                        </span>
                    @endif
                </td>
                <td>
                    @if($categoria->parent_id)
                        <span class="text-muted">
                            <i class="fa fa-folder text-primary"></i>
                            {{ $categoria->parent->nombre }}
                        </span>
                        <i class="fa fa-chevron-right text-muted mx-1" style="font-size:10px"></i>
                        <strong><i class="fa fa-tag text-info"></i> {{ $categoria->nombre }}</strong>
                    @else
                        <strong><i class="fa fa-folder text-primary"></i> {{ $categoria->nombre }}</strong>
                    @endif
                </td>
                <td>{{ $categoria->descripcion ?? '—' }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['categorias.destroy', $categoria->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('categorias.edit', [$categoria->id]) }}"
                           class='btn btn-default btn-xs' title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                            'type' => 'submit',
                            'class' => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('¿Eliminar esta categoría?')"
                        ]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>