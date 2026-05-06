@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-fire-alt text-warning mr-2"></i>Rutinas Diarias Elite</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-warning float-right" href="{{ route('admon.rutinas-diarias-elite.create') }}">
                        <i class="fas fa-plus mr-1"></i> Nueva Rutina
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        {{-- Filtros --}}
        <div class="card card-outline card-warning mb-3">
            <div class="card-body">
                <form method="GET" class="form-inline flex-wrap">
                    <div class="form-group mr-3 mb-2">
                        <label class="mr-2">Mes:</label>
                        <input type="month" name="mes" class="form-control form-control-sm"
                               value="{{ request('mes') }}">
                    </div>
                    <div class="form-group mr-3 mb-2">
                        <label class="mr-2">Día:</label>
                        <select name="dia" class="form-control form-control-sm">
                            <option value="">Todos</option>
                            @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'] as $d)
                                <option value="{{ $d }}" {{ request('dia') == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn btn-sm btn-warning mr-2 mb-2">
                        <i class="fas fa-search mr-1"></i>Filtrar
                    </button>
                    <a href="{{ route('admon.rutinas-diarias-elite.index') }}" class="btn btn-sm btn-secondary mb-2">
                        Limpiar
                    </a>
                </form>
            </div>
        </div>

        @php
            $colores = ['Lunes'=>'primary','Martes'=>'success','Miércoles'=>'info',
                        'Jueves'=>'warning','Viernes'=>'danger','Sábado'=>'secondary'];
            $diasOrden = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        @endphp

        @if($rutinas->isEmpty())
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-dumbbell fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay rutinas diarias elite registradas.<br>
                        <a href="{{ route('admon.rutinas-diarias-elite.create') }}">Crear la primera</a>
                    </p>
                </div>
            </div>
        @else
            @foreach($diasOrden as $dia)
                @if(isset($rutinas[$dia]) && $rutinas[$dia]->count())
                <div class="card card-outline card-{{ $colores[$dia] }} mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            <span class="badge badge-{{ $colores[$dia] }} mr-2">{{ $dia }}</span>
                        </h3>
                        <div class="card-tools">
                            <span class="badge badge-light">{{ $rutinas[$dia]->count() }} rutina(s)</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Título</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Video</th>
                                    <th width="120">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rutinas[$dia] as $rutina)
                                <tr>
                                    <td><strong>{{ $rutina->titulo }}</strong></td>
                                    <td>
                                        <i class="far fa-calendar-alt mr-1 text-muted"></i>
                                        {{ $rutina->fecha->format('d/m/Y') }}
                                    </td>
                                    <td>{{ Str::limit($rutina->descripcion, 60) ?? '—' }}</td>
                                    <td>
                                        @if($rutina->getRawOriginal('video_url'))
                                            <span class="badge badge-success"><i class="fas fa-video mr-1"></i>Sí</span>
                                        @else
                                            <span class="badge badge-secondary">Sin video</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admon.rutinas-diarias-elite.edit', $rutina) }}"
                                           class="btn btn-xs btn-info mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admon.rutinas-diarias-elite.destroy', $rutina) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('¿Eliminar esta rutina?')">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-xs btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            @endforeach
        @endif

    </div>
@endsection