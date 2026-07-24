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

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="filtroCategoria"><strong>Filtrar por categoría:</strong></label>
            <select id="filtroCategoria" class="form-control">
                <option value="todas">Todas las categorías</option>
                @php
                    $categoriasUnicas = $coffee_products->pluck('coffeeCategory')->filter()->unique('id');
                @endphp
                @foreach($categoriasUnicas as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
                <option value="sin-categoria">Sin categoría</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered" id="tablaProductos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($coffee_products as $product)
            <tr class="fila-producto" data-categoria="{{ $product->coffeeCategory ? $product->coffeeCategory->id : 'sin-categoria' }}">
                <td>
                    @if($product->imagen)
                        <img src="{{ asset('storage/'.$product->imagen) }}" width="80">
                    @endif
                </td>
                <td>{{ $product->nombre }}</td>
                <td>
                    @if($product->coffeeCategory)
                        <span class="badge badge-info">{{ $product->coffeeCategory->nombre }}</span>
                    @else
                        <span class="badge badge-secondary">Sin categoría</span>
                    @endif
                </td>
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

    <p id="sinResultados" class="text-muted" style="display:none;">
        No hay productos en esta categoría.
    </p>
</div>

@push('page_scripts')
<script>
    $(document).ready(function() {
        $('#filtroCategoria').on('change', function() {
            var categoriaSeleccionada = $(this).val();
            var filasVisibles = 0;

            $('.fila-producto').each(function() {
                var categoriaFila = $(this).data('categoria').toString();

                if (categoriaSeleccionada === 'todas' || categoriaFila === categoriaSeleccionada) {
                    $(this).show();
                    filasVisibles++;
                } else {
                    $(this).hide();
                }
            });

            if (filasVisibles === 0) {
                $('#sinResultados').show();
            } else {
                $('#sinResultados').hide();
            }
        });
    });
</script>
@endpush
@endsection