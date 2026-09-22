@extends('website.layouts.app')
@section('title', 'Procesar pago | Fitness Club Tunja')
@section('content')
<main class="container" style="padding:100px 15px;text-align:center;color:#fff;min-height:60vh">
   <h1>Procesando tu pago</h1>
   <p style="color:#aaa">Serás redirigido a Wompi para completar la compra.</p>
   <form>
      <script
         src="https://checkout.wompi.co/widget.js"
         data-render="button"
         data-public-key="{{ $publicKey }}"
         data-currency="COP"
         data-amount-in-cents="{{ $amountInCents }}"
         data-reference="{{ $factura->referencia }}"
         data-signature:integrity="{{ $signature }}"
         data-redirect-url="{{ route('website.pagos.respuesta') }}"
         data-customer-data:email="{{ $customer['email'] }}"
         data-customer-data:full-name="{{ $customer['nombre'] }}"
         data-customer-data:phone-number="{{ $customer['telefono'] }}"
         data-customer-data:phone-number-prefix="+57">
      </script>
   </form>
</main>
@endsection
@push('page_scripts')
@endpush
