<div class="table-responsive">
    <table class="table" id="medicions-table">
        <thead>
        <tr>
            <th>User Id</th>
        <th>Fecha Medicion</th>
        <th>Peso</th>
        <th>Talla</th>
        <th>Grasa</th>
        <th>Musculo</th>
        <th>Perimetro Abdominal</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($medicions as $medicion)
            <tr>
                <td>{{ $medicion->user_id }}</td>
            <td>{{ $medicion->fecha_medicion }}</td>
            <td>{{ $medicion->peso }}</td>
            <td>{{ $medicion->talla }}</td>
            <td>{{ $medicion->grasa }}</td>
            <td>{{ $medicion->musculo }}</td>
            <td>{{ $medicion->perimetro_abdominal }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['medicions.destroy', $medicion->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('medicions.show', [$medicion->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('medicions.edit', [$medicion->id]) }}"
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
