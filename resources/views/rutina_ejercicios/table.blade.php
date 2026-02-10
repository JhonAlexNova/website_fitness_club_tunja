<div class="table-responsive">
    <table class="table" id="rutinaEjercicios-table">
        <thead>
        <tr>
            <th>Id Rutina</th>
            <th>Id Ejercicio</th>
            <th>Repeticiones</th>
            <th>Series</th>
            <th>Descanso Segundos</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rutinaEjercicios as $rutinaEjercicio)
            <tr>
                <td>{{ $rutinaEjercicio->id_rutina }}</td>
                <td>{{ $rutinaEjercicio->id_ejercicio }}</td>
                <td>{{ $rutinaEjercicio->repeticiones }}</td>
                <td>{{ $rutinaEjercicio->series }}</td>
                <td>{{ $rutinaEjercicio->descanso_segundos }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['rutinaEjercicios.destroy', $rutinaEjercicio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('rutinaEjercicios.show', [$rutinaEjercicio->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('rutinaEjercicios.edit', [$rutinaEjercicio->id]) }}"
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
