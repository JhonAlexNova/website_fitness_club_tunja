<div class="table-responsive-">
    <table class="table datatableSimple" id="membresias-table">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Descripcion</th>
            <th>Costo</th>
            <th>Duración</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($membresias as $membresia)
            <tr>
                <td>{{ $membresia->nombre }}</td>
               <td>
                    @if($membresia->imagen)
                        <img src="{{ asset('images/membresias/'.$membresia->imagen) }}" width="80">
                    @else
                        <span class="text-muted">Sin imagen</span>
                    @endif
                </td>
                <td>{{ $membresia->descripcion }}</td>
                <td>{{ $membresia->costo }}</td>
                <td>{{ $membresia->duracion }} {{ $membresia->tipo_duracion }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['membresias.destroy', $membresia->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                       {{--  <a href="{{ route('membresias.show', [$membresia->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a> --}}
                        <a href="{{ route('membresias.edit', [$membresia->id]) }}"
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
