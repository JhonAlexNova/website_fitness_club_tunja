<div class="table-responsive">
    <table class="table" id="ejercicios-table">
        <thead>
            <tr>
                <th>Nombre Ejercicio</th>
                <th>Musculo Objetivo</th>
                <th>Equipo</th>
                <th>Nivel Dificultad</th>
                <th>Video</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ejercicios as $ejercicio)
            <tr>
                <td>{{ $ejercicio->nombre_ejercicio }}</td>
                <td>{{ $ejercicio->musculo_objetivo }}</td>
                <td>{{ $ejercicio->equipo }}</td>
                <td>{{ $ejercicio->nivel_dificultad }}</td>
                <td>
                    @if($ejercicio->video_url)
                    <button class="btn btn-sm btn-info btn-view-video" 
                            data-video-url="{{url('storage',$ejercicio->video_url)}}">
                        <i class="fas fa-play"></i> Ver Video
                    </button>
                    @else
                    <span class="text-muted">Sin video</span>
                    @endif
                </td>
                <td width="120">
                    {!! Form::open(['route' => ['ejercicios.destroy', $ejercicio->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ejercicios.edit', [$ejercicio->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('¿Estás seguro?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

