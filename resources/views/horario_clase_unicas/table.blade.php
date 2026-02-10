<div class="table-responsive">
    <table class="table" id="horarioClaseUnicas-table">
        <thead>
        <tr>
            <th>Clase Id</th>
        <th>Instructor Id</th>
        <th>Fecha Hora</th>
        <th>Cupo Maximo</th>
        <th>Cupos Disponibles</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($horarioClaseUnicas as $horarioClaseUnica)
            <tr>
                <td>{{ $horarioClaseUnica->clase->nombre }}</td>
            <td>
                {{ $horarioClaseUnica->instructor->primer_nombre }} 
                {{ $horarioClaseUnica->instructor->segundo_nombre }}
                {{ $horarioClaseUnica->instructor->primer_apellido }}
                {{ $horarioClaseUnica->instructor->segundo_apellido }}

            </td>
            <td>{{ $horarioClaseUnica->fecha_hora }}</td>
            <td>{{ $horarioClaseUnica->cupo_maximo }}</td>
            <td>{{ $horarioClaseUnica->cupos_disponibles }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['horarioClaseUnicas.destroy', $horarioClaseUnica->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('horarioClaseUnicas.show', [$horarioClaseUnica->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('horarioClaseUnicas.edit', [$horarioClaseUnica->id]) }}"
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
