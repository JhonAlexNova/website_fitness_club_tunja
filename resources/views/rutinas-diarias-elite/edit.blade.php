@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-edit text-warning mr-2"></i>Editar Rutina Diaria Elite</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-secondary float-right" href="{{ route('admon.rutinas-diarias-elite.index') }}">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-warning card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ $rutina->titulo }}</h3>
                    </div>
                    <form action="{{ route('admon.rutinas-diarias-elite.update', $rutina) }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="card-body">

                            <div class="form-group">
                                <label>Título <span class="text-danger">*</span></label>
                                <input type="text" name="titulo"
                                       class="form-control @error('titulo') is-invalid @enderror"
                                       value="{{ old('titulo', $rutina->titulo) }}">
                                @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Día de la semana <span class="text-danger">*</span></label>
                                        <select name="dia_semana" id="dia_semana"
                                                class="form-control @error('dia_semana') is-invalid @enderror">
                                            @foreach($dias as $dia)
                                                <option value="{{ $dia }}"
                                                    {{ old('dia_semana', $rutina->dia_semana) == $dia ? 'selected' : '' }}>
                                                    {{ $dia }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('dia_semana')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="far fa-calendar-alt mr-1"></i>Fecha <span class="text-danger">*</span></label>
                                        <input type="date" name="fecha" id="fecha"
                                               class="form-control @error('fecha') is-invalid @enderror"
                                               value="{{ old('fecha', $rutina->fecha->format('Y-m-d')) }}">
                                        @error('fecha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $rutina->descripcion) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label><i class="fas fa-video mr-1"></i>Video</label>
                                @if($rutina->getRawOriginal('video_url'))
                                    <div class="mb-2">
                                        <video width="100%" height="200" controls class="rounded">
                                            <source src="{{ $rutina->video_url }}" type="video/mp4">
                                        </video>
                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-info-circle"></i> Subir un nuevo video reemplazará el actual.
                                        </small>
                                    </div>
                                @endif
                                <div class="custom-file">
                                    <input type="file" name="video" id="video"
                                           class="custom-file-input @error('video') is-invalid @enderror"
                                           accept="video/mp4,video/avi,video/quicktime,video/webm">
                                    <label class="custom-file-label" for="video">Seleccionar nuevo video...</label>
                                </div>
                                @error('video')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('admon.rutinas-diarias-elite.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save mr-1"></i> Actualizar Rutina
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.getElementById('fecha').addEventListener('change', function () {
        const dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        const fecha = new Date(this.value + 'T00:00:00');
        const diaNombre = dias[fecha.getDay()];
        const select = document.getElementById('dia_semana');
        for (let opt of select.options) {
            if (opt.value === diaNombre) { opt.selected = true; break; }
        }
    });

    document.getElementById('video').addEventListener('change', function () {
        this.nextElementSibling.textContent = this.files[0] ? this.files[0].name : 'Seleccionar nuevo video...';
    });
</script>
@endsection