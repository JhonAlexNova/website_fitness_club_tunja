@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nuevo Código Influencer</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('codigos-influencers.index') }}">
                        <i class="fas fa-arrow-left mr-1"></i> Volver
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">

                <form
                    id="form-crear-codigo"
                    action="{{ route('codigos-influencers.store') }}"
                    method="POST">
                    @csrf

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="codigo">Código *</label>
                            <input
                                type="text"
                                id="codigo"
                                name="codigo"
                                class="form-control"
                                placeholder="Ej: FERXXO2025"
                                value="{{ old('codigo') }}"
                                style="text-transform:uppercase"
                                required>
                            <small class="text-muted">Se guardará en mayúsculas automáticamente.</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="creador">Nombre del creador</label>
                            <input
                                type="text"
                                id="creador"
                                name="creador"
                                class="form-control"
                                placeholder="Ej: Juan García"
                                value="{{ old('creador') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="max_usos">Máximo de usos</label>
                            <input
                                type="number"
                                id="max_usos"
                                name="max_usos"
                                class="form-control"
                                min="1"
                                placeholder="Dejar vacío = ilimitado"
                                value="{{ old('max_usos') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="fecha_expiracion">Fecha de expiración</label>
                            <input
                                type="date"
                                id="fecha_expiracion"
                                name="fecha_expiracion"
                                class="form-control"
                                value="{{ old('fecha_expiracion') }}">
                            <small class="text-muted">Dejar vacío = sin expiración.</small>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="custom-control custom-switch">
                                <input
                                    type="checkbox"
                                    class="custom-control-input"
                                    id="activo"
                                    name="activo"
                                    checked>
                                <label class="custom-control-label" for="activo">Código activo</label>
                            </div>
                        </div>

                    </div>

                    <div class="mt-3">
                        <button
                            type="button"
                            class="btn btn-primary"
                            onclick="document.getElementById('form-crear-codigo').submit()">
                            Crear código
                        </button>
                        <a href="{{ route('codigos-influencers.index') }}" class="btn btn-default ml-2">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection