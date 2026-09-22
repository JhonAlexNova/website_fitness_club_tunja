@extends('website.layouts.app')
@section('title', 'Resultado del pago | Fitness Club Tunja')
@section('content')
<main class="container" style="padding:110px 15px;text-align:center;color:#fff;min-height:60vh">
   <h1>Pago enviado</h1>
   <p style="color:#aaa">Estamos confirmando la transacción con Wompi. Conserva tu referencia para consultar el estado.</p>
   @if($reference)<p><strong>Referencia:</strong> {{ $reference }}</p>@endif
   <a class="cart-cta" href="{{ url('tienda') }}">Volver a la tienda</a>
</main>
@endsection
