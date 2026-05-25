@php
    $agrupados = $ejercicios->groupBy(function($ejercicio) {
        $principal = $ejercicio->musculos->firstWhere('pivot.es_principal', true);
        return $principal ? $principal->nombre : 'Sin categoría';
    });
@endphp

@foreach($agrupados as $musculo => $grupo)
<div class="card mb-3">
    <div class="card-header bg-primary">
        <h5 class="mb-0 text-white">
            <i class="fas fa-dumbbell mr-2"></i>{{ $musculo }}
            <span class="badge badge-light ml-2">{{ $grupo->count() }}</span>
        </h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Nombre Ejercicio</th>
                    <th>Descripción</th>
                    <th>Músculos Secundarios</th>
                    <th>Equipo</th>
                    <th>Nivel Dificultad</th>
                    <th>Video</th>
                    <th>Modelo 3D</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupo as $ejercicio)
                <tr>
                    <td>{{ $ejercicio->nombre_ejercicio }}</td>
                    <td>
                        @if($ejercicio->descripcion)
                            <button class="btn btn-xs btn-info btn-descripcion"
                                    data-nombre="{{ $ejercicio->nombre_ejercicio }}"
                                    data-descripcion="{{ $ejercicio->descripcion }}"
                                    data-toggle="modal"
                                    data-target="#modalDescripcion">
                                <i class="fas fa-info-circle"></i> Ver
                            </button>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>
                        @foreach($ejercicio->musculos as $m)
                            @if(!$m->pivot->es_principal)
                                <span class="badge badge-secondary">{{ $m->nombre }}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $ejercicio->equipo }}</td>
                    <td>{{ $ejercicio->nivel_dificultad }}</td>
                    <td>
                        @if($ejercicio->video_url)
                            <button class="btn btn-sm btn-info btn-view-video"
                                    data-video-url="{{ url('storage', $ejercicio->video_url) }}">
                                <i class="fas fa-play"></i> Ver Video
                            </button>
                        @else
                            <span class="text-muted">Sin video</span>
                        @endif
                    </td>
                    <td>
                        @if($ejercicio->modelo_3d)
                            <a class="btn btn-sm btn-outline-primary" 
                               href="{{ url('storage', $ejercicio->modelo_3d) }}" target="_blank">
                                <i class="fas fa-cube"></i> Ver
                            </a>
                        @else
                            <span class="text-muted">Sin modelo</span>
                        @endif
                    </td>
                    <td width="120">

                        {!! Form::open(['route' => ['ejercicios.destroy', $ejercicio->id], 'method' => 'delete']) !!}
                        <div class="btn-group">
                            <a href="{{ route('ejercicios.edit', [$ejercicio->id]) }}"
                               class="btn btn-default btn-xs">
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type'    => 'submit',
                                'class'   => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('¿Estás seguro?')"
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

{{-- Modal Descripción --}}
<div class="modal fade" id="modalDescripcion" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">
                    <i class="fas fa-dumbbell mr-2"></i>
                    <span id="modalNombre"></span>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalDescripcionTexto" style="white-space: pre-line;"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-descripcion').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('modalNombre').textContent = this.dataset.nombre;
            document.getElementById('modalDescripcionTexto').textContent = this.dataset.descripcion;
        });
    });
</script>