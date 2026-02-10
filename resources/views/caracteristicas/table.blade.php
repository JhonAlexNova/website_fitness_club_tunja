<div class="table-responsive">
    <table class="table" id="caracteristicas-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($caracteristicas as $caracteristica)
            <tr>
                <td>{{ $caracteristica->nombre }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['caracteristicas.destroy', $caracteristica->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('caracteristicas.show', [$caracteristica->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('caracteristicas.edit', [$caracteristica->id]) }}"
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
