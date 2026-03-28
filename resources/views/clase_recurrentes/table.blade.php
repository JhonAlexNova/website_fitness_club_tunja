@php
    $dias = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miércoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
@endphp

<div class="table-responsive">
    <table class="table datatableSimple" id="claseRecurrentes-table">
        <thead>
            <tr>
                <th>Clase</th>
                <th>Día Semana</th>
                <th>Hora</th>
                <!-- <th>Instructor Id</th> -->
                <th>Duración Min</th>
                <th>Cupo Máximo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($claseRecurrentes as $claseRecurrente)
                <tr>
                    <td>{{ optional($claseRecurrente->clase)->nombre ?? 'Clase no disponible' }}</td>
                    <td>{{ $dias[$claseRecurrente->dia_semana] ?? 'Día inválido' }}</td>
                    <td>{{ $claseRecurrente->hora }}</td>
                    {{-- 
                    <td>
                        {{ $claseRecurrente->instructor->primer_nombre }}
                        {{ $claseRecurrente->instructor->segundo_nombre }}
                        {{ $claseRecurrente->instructor->primer_apellido }}
                        {{ $claseRecurrente->instructor->segundo_apellido }}
                    </td>
                    --}}
                    <td>{{ $claseRecurrente->duracion }}</td>
                    <td>{{ $claseRecurrente->cupo_maximo }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['claseRecurrentes.destroy', $claseRecurrente->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>

                            <a href="{{ route('claseRecurrentes.edit', [$claseRecurrente->id]) }}" class='btn btn-default btn-xs'>
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
