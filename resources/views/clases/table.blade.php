<table class="table table-striped table-bordered">
    <thead class="thead-dark">
        <tr>
            <th style="width:90px">Imagen</th>
            <th>Nombre</th>
            <th style="width:120px">Acciones</th>
        </tr>
    </thead>

    <tbody>
    @foreach($clases as $clase)
        <tr>
            <td class="text-center">
                @if($clase->imagen)
                    <img src="{{ asset('storage/'.$clase->imagen) }}"
                         width="70"
                         height="70"
                         style="object-fit:cover;border-radius:8px;">
                @else
                    <span class="text-muted">Sin imagen</span>
                @endif
            </td>

            <td style="vertical-align:middle">
                <strong>{{ $clase->nombre }}</strong>
            </td>

            <td class="text-center" style="vertical-align:middle">
                {!! Form::open(['route' => ['admon.clases.destroy', $clase->id], 'method' => 'delete']) !!}
                <div class="btn-group">
                    <a href="{{ route('admon.clases.edit', $clase->id) }}" 
                       class="btn btn-sm btn-primary">
                        <i class="far fa-edit"></i>
                    </a>

                    {!! Form::button('<i class="far fa-trash-alt"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-sm btn-danger',
                        'onclick' => "return confirm('¿Eliminar esta clase?')"
                    ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>