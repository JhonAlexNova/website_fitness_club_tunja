@extends("website.layouts.app")

@push("page_styles")
<style>
   body { background: radial-gradient(circle at top, #0f0f1f, #050505) !important; color: #fff; }
   .cart-page { padding: 56px 0 96px; min-height: calc(100vh - 80px); }
   .cart-page .container, .cart-page .row > [class*="col-"] { min-width: 0; }
   .cart-page .section-title h1 {
      color: #fff; font-size: clamp(1.8rem, 4vw, 2.6rem); font-weight: 900; text-transform: uppercase;
      background: linear-gradient(90deg, #8a2be2, #00f0ff); -webkit-background-clip: text;
      -webkit-text-fill-color: transparent; background-clip: text;
   }
   .cart-breadcrumb { display: flex; justify-content: center; gap: 10px; list-style: none; padding: 0; margin: 15px 0 0; color: #aaa; }
   .cart-breadcrumb a { color: #00f0ff; }
   .cart-card { margin-top: 52px; padding: clamp(24px, 4vw, 44px); background: rgba(20,20,40,.82); border-left: 4px solid #00f0ff; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,.35); }
   .cart-empty { text-align: center; color: #aaa; }
   .cart-empty i { color: #00f0ff; font-size: 3rem; margin-bottom: 18px; }
   .cart-empty h2 { color: #fff; font-size: clamp(1.25rem, 3vw, 1.7rem); }
   .cart-empty p { margin-bottom: 24px; }
   .cart-cta { display: inline-flex; align-items: center; justify-content: center; min-height: 46px; padding: 0 24px; border-radius: 24px; color: #fff !important; background: linear-gradient(90deg, #8a2be2, #00f0ff); font-weight: 700; text-transform: uppercase; letter-spacing: .7px; }
   .cart-table-wrap { overflow-x: auto; }
   .cart-table { width: 100%; min-width: 620px; border-collapse: collapse; }
   .cart-table th, .cart-table td { padding: 15px 12px; border-bottom: 1px solid rgba(255,255,255,.1); }
   .cart-table th { color: #00f0ff; text-align: left; text-transform: uppercase; font-size: .78rem; }
   .cart-table td { color: #fff; }
   .cart-table input { width: 70px; padding: 8px; border-radius: 7px; border: 1px solid rgba(138,43,226,.5); background: #0b0b18; color: #fff; text-align: center; }
   .cart-remove { color: #ff6b81; border: 0; background: transparent; cursor: pointer; }
   .cart-summary { display: flex; justify-content: flex-end; margin-top: 24px; }
   .cart-summary strong { color: #00f0ff; font-size: 1.4rem; }
   @media (max-width: 767px) { .cart-page { padding: 38px 0 70px; } .cart-card { margin-top: 34px; padding: 24px 16px; } }
</style>
@endpush

@section("title", "Carrito | Fitness Club Tunja")

@section("content")
<main class="cart-page">
   <div class="container">
      <div class="section-title text-center">
         <h1>Carrito de compras</h1>
         <ol class="cart-breadcrumb">
            <li><a href="{{ url('/') }}">Inicio</a></li>
            <li aria-hidden="true">›</li>
            <li>Carrito</li>
         </ol>
      </div>
      <section class="cart-card" aria-live="polite">
         <div id="cart-empty" class="cart-empty">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            <h2>Tu carrito está vacío</h2>
            <p>Explora nuestros productos y agrega lo que necesitas para tu entrenamiento.</p>
            <a class="cart-cta" href="{{ url('tienda') }}">Ir a la tienda</a>
         </div>
         <div id="cart-content" hidden>
            <div class="cart-table-wrap">
               <table class="cart-table">
                  <thead><tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Total</th><th><span class="sr-only">Acciones</span></th></tr></thead>
                  <tbody id="cart-items"></tbody>
               </table>
            </div>
            <div class="cart-summary"><span>Total: <strong id="total-price">$0</strong></span></div>
            <div class="text-right mt-4"><a class="cart-cta" href="{{ url('tienda') }}">Seguir comprando</a></div>
         </div>
      </section>
   </div>
</main>
@endsection

@push("page_scripts")
<script src="{{ url('template/website/assets/js/carrito.js') }}"></script>
@endpush
