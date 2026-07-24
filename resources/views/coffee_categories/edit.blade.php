@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Categoría</h2>

    <form action="{{ route('coffee-categories.update',$coffee_category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $coffee_category->nombre }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Orden</label>
            <input type="number" name="orden" class="form-control" value="{{ $coffee_category->orden }}">
        </div>

        <div class="form-group form-check mb-3">
            <input type="checkbox" name="activo" class="form-check-input" id="activoCheck" {{ $coffee_category->activo ? 'checked' : '' }}>
            <label class="form-check-label" for="activoCheck">Activo</label>
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection