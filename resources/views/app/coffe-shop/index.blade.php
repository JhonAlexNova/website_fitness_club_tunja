@foreach($productos as $producto)

<h3>{{ $producto->nombre }}</h3>
<p>{{ $producto->descripcion }}</p>
<p>${{ $producto->precio }}</p>

@endforeach