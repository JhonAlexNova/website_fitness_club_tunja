<div class="table-responsive">
    <table class="table" id="rutinas-table">
        <thead>
        <tr>
            <th>Nombre Rutina</th>
        <th>Descripcion</th>
        <th>Duracion Semanas</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rutinas as $rutina)
            <tr>
                <td>{{ $rutina->nombre_rutina }}</td>
            <td>{{ $rutina->descripcion }}</td>
            <td>{{ $rutina->duracion_semanas }}</td>
            <td>{{ $rutina->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['admon.rutinas.destroy', $rutina->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('admon.rutinas.show', [$rutina->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('admon.rutinas.edit', [$rutina->id]) }}"
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
