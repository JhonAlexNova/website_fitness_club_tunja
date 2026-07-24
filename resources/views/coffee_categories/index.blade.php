@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Coffee Shop - Categorías</h2>

    <a href="{{ route('coffee-categories.create') }}" class="btn btn-primary mb-3">
        Crear Categoría
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Orden</th>
                <th>Nombre</th>
                <th>Activo</th>
                <th># Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coffee_categories as $category)
            <tr>
                <td>{{ $category->orden }}</td>
                <td>{{ $category->nombre }}</td>
                <td>
                    @if($category->activo)
                        <span class="badge badge-success">Sí</span>
                    @else
                        <span class="badge badge-secondary">No</span>
                    @endif
                </td>
                <td>{{ $category->coffeeProducts()->count() }}</td>
                <td>
                    <a href="{{ route('coffee-categories.edit',$category->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('coffee-categories.destroy',$category->id) }}"
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