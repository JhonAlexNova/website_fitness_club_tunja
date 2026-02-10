<div class="table-responsive">
    <table class="table" id="userRutinas-table">
        <thead>
        <tr>
            <th>User Id</th>
        <th>Id Rutina</th>
        <th>Fecha Inicio</th>
        <th>Fecha Fin</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($userRutinas as $userRutina)
            <tr>
                <td>{{ $userRutina->user_id }}</td>
            <td>{{ $userRutina->id_rutina }}</td>
            <td>{{ $userRutina->fecha_inicio }}</td>
            <td>{{ $userRutina->fecha_fin }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['userRutinas.destroy', $userRutina->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('userRutinas.show', [$userRutina->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('userRutinas.edit', [$userRutina->id]) }}"
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
