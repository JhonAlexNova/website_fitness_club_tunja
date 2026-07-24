@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Producto Coffee Shop</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('coffee-products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Categoría</label>
            <select name="coffee_category_id" class="form-control">
                <option value="">-- Sin categoría --</option>
                @foreach($coffee_categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection