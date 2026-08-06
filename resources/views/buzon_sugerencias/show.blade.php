@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detalle del Mensaje</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('buzon-sugerencias.index') }}">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="card">
            <div class="card-body p-3">

                <dl class="row">
                    <dt class="col-sm-3">Usuario</dt>
                    <dd class="col-sm-9">{{ $mensaje->usuario ? trim($mensaje->usuario->primer_nombre.' '.$mensaje->usuario->primer_apellido) : '—' }}</dd>

                    <dt class="col-sm-3">Tipo</dt>
                    <dd class="col-sm-9">
                        <span class="badge badge-info">
                            {{ \App\Models\BuzonSugerencia::tipos()[$mensaje->tipo] ?? $mensaje->tipo }}
                        </span>
                    </dd>

                    <dt class="col-sm-3">Estado</dt>
                    <dd class="col-sm-9">
                        @if($mensaje->estado === 'nuevo')
                            <span class="badge badge-danger">Nuevo</span>
                        @elseif($mensaje->estado === 'leido')
                            <span class="badge badge-warning">Leído</span>
                        @else
                            <span class="badge badge-success">Respondido</span>
                        @endif
                    </dd>

                    <dt class="col-sm-3">Fecha</dt>
                    <dd class="col-sm-9">{{ $mensaje->created_at->format('d/m/Y H:i') }}</dd>

                    <dt class="col-sm-3">Mensaje</dt>
                    <dd class="col-sm-9">{{ $mensaje->mensaje }}</dd>
                </dl>

                <hr>

                <h5>Responder</h5>

                {!! Form::open(['route' => ['buzon-sugerencias.responder', $mensaje->id], 'method' => 'post']) !!}
                    <div class="form-group">
                        {!! Form::textarea('respuesta', $mensaje->respuesta, [
                            'class'       => 'form-control',
                            'rows'        => 4,
                            'placeholder' => 'Escribe tu respuesta aquí...'
                        ]) !!}
                    </div>
                    {!! Form::button('Enviar respuesta', [
                        'type'  => 'button',
                        'class' => 'btn btn-primary',
                        'onclick' => 'this.closest("form").submit();'
                    ]) !!}
                {!! Form::close() !!}

                @if($mensaje->respondido_at)
                    <p class="text-muted mt-2">
                        Respondido el {{ $mensaje->respondido_at->format('d/m/Y H:i') }}
                    </p>
                @endif

            </div>
        </div>
    </div>
@endsection