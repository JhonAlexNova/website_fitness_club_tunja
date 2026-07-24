@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Categoría Coffee Shop</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('coffee-categories.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Orden</label>
            <input type="number" name="orden" class="form-control" value="0">
        </div>

        <div class="form-group form-check mb-3">
            <input type="checkbox" name="activo" class="form-check-input" id="activoCheck" checked>
            <label class="form-check-label" for="activoCheck">Activo</label>
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection