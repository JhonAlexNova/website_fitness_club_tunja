@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>

    <form action="{{ route('coffee-products.update',$coffee_product->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Nombre</label>
            <input type="text" 
                   name="nombre" 
                   class="form-control" 
                   value="{{ $coffee_product->nombre }}" 
                   required>
        </div>

        <div class="form-group mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required>
                {{ $coffee_product->descripcion }}
            </textarea>
        </div>

        <div class="form-group mb-3">
            <label>Precio</label>
            <input type="number" 
                   step="0.01" 
                   name="precio" 
                   class="form-control" 
                   value="{{ $coffee_product->precio }}" 
                   required>
        </div>

        <div class="form-group mb-3">
            <label>Imagen actual</label><br>
            @if($coffee_product->imagen)
                <img src="{{ asset('storage/'.$coffee_product->imagen) }}" width="100">
            @endif
        </div>

        <div class="form-group mb-3">
            <label>Cambiar Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection