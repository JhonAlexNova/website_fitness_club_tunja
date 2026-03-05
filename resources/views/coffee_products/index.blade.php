@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Coffee Shop - Productos</h2>

    <a href="{{ route('coffee-products.create') }}" class="btn btn-primary mb-3">
        Crear Producto
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coffee_products as $product)
            <tr>
                <td>
                    @if($product->imagen)
                        <img src="{{ asset('storage/'.$product->imagen) }}" width="80">
                    @endif
                </td>
                <td>{{ $product->nombre }}</td>
                <td>{{ $product->descripcion }}</td>
                <td>${{ $product->precio }}</td>
                <td>
                    <a href="{{ route('coffee-products.edit',$product->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('coffee-products.destroy',$product->id) }}" 
                          method="POST" 
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection