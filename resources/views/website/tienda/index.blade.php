@extends("website.layouts.app")
@push("page_styles")
<link rel="stylesheet" href="{{url('template/website/assets/css/tienda.css')}}">
<style>
body {
    background: radial-gradient(circle at top, #0f0f1f, #050505) !important;
    color: #fff;
}

/* HERO */
.shop-bg.page-head {
    padding: 64px 0 42px;
    margin: 0;
    min-height: 210px;
}
.shop-bg .section-title h3 {
    color: #fff;
    font-size: clamp(1.8rem, 5vw, 2.5rem);
    line-height: 1.15;
    font-weight: 900;
    text-transform: uppercase;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.mobile-break { display: none; }
.breadcrumb li, .breadcrumb li a { color: #aaa !important; }

/* ÁREA PRINCIPAL */
.product-area.shopping-area {
    background: transparent;
    padding: 64px 0 96px !important;
}

.product-area.shopping-area > .container {
    max-width: 1180px;
}

.product-area.shopping-area .row > [class*="col-"] {
    min-width: 0;
}

.product-area.shopping-area > .container > .row + .row {
    align-items: flex-start;
}

.product-area.shopping-area .products-grid {
    min-width: 0;
}

/* TÍTULO SECCIÓN */
.section-title h3 {
    color: #fff !important;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.section-title p { color: #aaa !important; }

/* SIDEBAR FILTROS */
.shop-filters {
    position: relative;
}

.shop-filters-title {
    margin: 0 0 16px;
    padding: 0 4px 12px;
    color: #fff;
    font-size: .95rem;
    font-weight: 800;
    letter-spacing: 1.2px;
    text-transform: uppercase;
    border-bottom: 1px solid rgba(0, 240, 255, .28);
}

.shop-filters-title span {
    color: #00f0ff;
}

.shop-filters-title small {
    display: block;
    margin-top: 5px;
    color: #777b94;
    font-size: .7rem;
    font-weight: 400;
    letter-spacing: 0;
    text-transform: none;
}

.accordion .card {
    background: linear-gradient(145deg, rgba(27, 27, 52, .96), rgba(14, 14, 31, .96)) !important;
    border: 1px solid rgba(255,255,255,.08) !important;
    border-radius: 12px !important;
    margin-bottom: 10px !important;
    box-shadow: 0 8px 22px rgba(0,0,0,.2);
    transition: border-color .25s ease, transform .25s ease, box-shadow .25s ease;
}
.accordion .card:hover {
    border-color: rgba(0, 240, 255, .45) !important;
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(0,0,0,.3);
}

@media (min-width: 992px) {
    .product-area.shopping-area .accordion {
        position: sticky;
        top: 104px;
    }
}
.accordion .card:nth-child(even) {
    border-left-color: rgba(255,255,255,.08) !important;
}
.accordion .card-header {
    background: transparent !important;
    border: none !important;
    padding: 0 !important;
}
.btn-link {
    color: #fff !important;
    font-weight: 700 !important;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: .7px;
    display: flex !important;
    align-items: center;
    width: 100%;
    padding: 15px 14px !important;
    text-align: left;
}
.btn-link i { color: #00f0ff; width: 22px; margin-right: 4px; }
.btn-link:hover { color: #00f0ff !important; text-decoration: none !important; }
.card-body { color: #9ea2b8 !important; background: transparent !important; padding: 0 18px 16px !important; }
.form-check-label { color: #aaa !important; }
.form-check-label i { display: none; }
.form-check { margin: 8px 0; padding-left: 0 !important; display: flex; align-items: center; gap: 9px; }
.form-check-input { position: static !important; margin: 0 !important; flex: 0 0 13px; }
.form-check-label { padding-left: 4px; font-size: .86rem; }
.form-check-input { accent-color: #8a2be2; }
.form-control-range { width: 100%; accent-color: #00d9ff; }
.color-box { flex: 0 0 25px; }

/* CARDS DE PRODUCTOS */
.product-box {
    background: rgba(20,20,40,0.8) !important;
    border-radius: 20px !important;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.07);
    backdrop-filter: blur(15px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
    margin-bottom: 25px;
    min-width: 0;
}
.product-box:nth-child(even) { border-color: rgba(255,255,255,.07); }
.product-box:hover { transform: translateY(-8px); border-color: rgba(0, 240, 255, .55); box-shadow: 0 20px 40px rgba(0,0,0,0.5); }

.cart-box .cart-img img {
    width: 100%;
    aspect-ratio: 4 / 3;
    height: auto;
    object-fit: cover;
    display: block;
}

.cart-box .cart-img {
    overflow: hidden;
    background: #111124;
}

.cart-dtl {
    padding: 15px 20px 20px !important;
}
.cart-dtl .titulo h4 {
    color: #fff !important;
    font-size: 1rem;
    font-weight: 700;
    margin-bottom: 8px;
}
.cart-dtl .precio span {
    font-size: 1.2rem;
    font-weight: 900;
    background: linear-gradient(90deg, #00f0ff, #8a2be2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cart-dtl .btnComprar {
    margin-top: 12px;
}
.btnComprarProducto {
    display: block;
    width: 100%;
    padding: 12px;
    border-radius: 25px;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    color: #fff !important;
    font-weight: 700;
    font-size: 0.9rem;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    transition: 0.3s;
}
.btnComprarProducto:hover {
    opacity: 0.85;
    transform: translateY(-2px);
    color: #fff !important;
    text-decoration: none;
}

/* OVERLAY */
.primary-overlay:before {
    background: rgba(138, 43, 226, 0.6) !important;
}

/* OVERRIDE tienda.css */
.product-area .product-box {
    background: rgba(20,20,40,0.8) !important;
    padding: 0 0 15px 0 !important;
    border: 1px solid rgba(255,255,255,.07) !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.4) !important;
    min-height: 0 !important;
    display: flex !important;
    flex-direction: column !important;
}
.product-area .product-box .cart-dtl {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    padding: 15px 20px 20px !important;
}
a.btnComprarProducto {
    background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
    width: 100% !important;
    margin: 0 !important;
}
.precio { color: #fff !important; }

/* Estado vacío (sin productos) */
.empty-state {
    text-align: center;
    color: #aaa;
    padding: 60px 20px;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .mobile-break { display: inline; }
    .shop-bg.page-head { width: 100vw; padding: 38px 15px 30px; min-height: 190px; }
    .product-area.shopping-area { width: 100%; max-width: 100%; padding: 42px 0 70px !important; overflow: hidden; }
    .product-area.shopping-area > .container { width: 100%; max-width: 100%; padding-left: 15px; padding-right: 15px; }
    .product-area.shopping-area > .container > .row { width: 100%; margin-left: 0; margin-right: 0; }
    .product-area.shopping-area > .container > .row > .shop-filters,
    .product-area.shopping-area > .container > .row > .col-md-9 { flex: 0 0 100%; max-width: 100%; width: 100%; padding-left: 0; padding-right: 0; }
    .product-area.shopping-area .products-grid { width: 100%; margin-left: 0; margin-right: 0; }
    .shop-bg .section-title h3,
    .product-area.shopping-area .section-title h3 { display: block !important; width: calc(100vw - 30px) !important; max-width: calc(100vw - 30px) !important; margin-left: auto !important; margin-right: auto !important; font-size: 1.45rem !important; line-height: 1.2; white-space: normal !important; overflow-wrap: anywhere !important; word-break: break-word !important; }
    .product-area.shopping-area .section-title p { display: block !important; width: calc(100vw - 30px) !important; max-width: calc(100vw - 30px) !important; margin-left: auto !important; margin-right: auto !important; font-size: .75rem; line-height: 1.45; white-space: normal !important; overflow-wrap: anywhere !important; }
    .product-area.shopping-area > .container > .row + .row > .col-md-3 { margin-bottom: 28px; }
    .product-area.shopping-area .products-grid > [class*="col-"] { flex: 0 0 100%; max-width: 100%; }
    .product-box { border-radius: 14px !important; }
    .cart-dtl { padding: 14px 14px 16px !important; }
    .cart-dtl .titulo h4 { font-size: .92rem; line-height: 1.3; overflow-wrap: anywhere; }
    .btnComprarProducto { padding: 10px 8px; font-size: .78rem; }
}
</style>
@endpush
@section("title","Tienda Fitness Club Tunja")
@section("seo_description", "Compra ropa y equipamiento fitness en Fitness Club Tunja. Encuentra productos para complementar tu entrenamiento en Boyacá.")
@section("seo_canonical", url('tienda'))
@section("content")
<div class="shop-bg page-head parallax overlay">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <h3>Tienda Fitness<span class="mobile-break"><br></span> Club</h3>
            </div>
         </div>
         <div class="col-md-12">
            <ol class="breadcrumb">
               <li><a href="{{ url('/') }}">Inicio</a></li>
               <li>›</li>
               <li>Tienda Fitness</li>
            </ol>
         </div>
      </div>
   </div>
</div>

<div class="product-area shopping-area pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20" style="width:60px;height:3px;background:#1a3cff;margin:0 auto 20px;border-radius:3px;"></div>
               <h3>Productos y<span class="mobile-break"><br></span> Equipamiento<span class="mobile-break"><br></span> Fitness</h3>
               <p>Encuentra todo lo que necesitas<span class="mobile-break"><br></span> para potenciar tu entrenamiento</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3 shop-filters">
            <div class="shop-filters-title"><span>ENTRENA</span> TU ESTILO<small>Encuentra el equipo ideal para tu rutina</small></div>
            <!--  -->

   <div class="accordion" id="filterAccordion">
      <!-- Categorías -->
      <div class="card border-0 mb-2 shadow-sm">
         <div class="card-header " id="headingCategories">
            <h2 class="mb-0">
               <button class="btn btn-link  text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                  <i class="fa fa-tags"></i> Categorías
               </button>
            </h2>
         </div>
         <div id="collapseCategories" class="collapse show" aria-labelledby="headingCategories" data-parent="#filterAccordion">
            <div class="card-body">
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="category1">
                  <label class="form-check-label" for="category1"><i class="fas fa-tshirt"></i> Camisetas</label>
               </div>
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="category2">
                  <label class="form-check-label" for="category2"><i class="fas fa-running"></i> Pantalones</label>
               </div>
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="category3">
                  <label class="form-check-label" for="category3"><i class="fas fa-hat-cowboy"></i> Accesorios</label>
               </div>
            </div>
         </div>
      </div>

      <!-- Precio -->
      <div class="card border-0 mb-2 shadow-sm">
         <div class="card-header " id="headingPrice">
            <h2 class="mb-0">
               <button class="btn btn-link  text-decoration-none" type="button" data-toggle="collapse" data-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                  <i class="fa fa-usd"></i> Precio
               </button>
            </h2>
         </div>
         <div id="collapsePrice" class="collapse show" aria-labelledby="headingPrice" data-parent="#filterAccordion">
            <div class="card-body">
               <p>Rango de precios: <strong>$500 - $1000</strong></p>
               <input type="range" class="form-control-range" id="priceRange" min="500" max="1000" step="50">
            </div>
         </div>
      </div>

      <!-- Color -->
      <div class="card border-0 mb-2 shadow-sm">
         <div class="card-header " id="headingColor">
            <h2 class="mb-0">
               <button class="btn btn-link  text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseColor" aria-expanded="false" aria-controls="collapseColor">
                  <i class="fa fa-eyedropper"></i> Color
               </button>
            </h2>
         </div>
         <div id="collapseColor" class="collapse show" aria-labelledby="headingColor" data-parent="#filterAccordion">
            <div class="card-body d-flex">
               <div class="color-box mr-2" style="width: 25px; height: 25px; background-color: #000; border-radius: 50%; border: 1px solid #ddd;"></div>
               <div class="color-box mr-2" style="width: 25px; height: 25px; background-color: #ff0000; border-radius: 50%; border: 1px solid #ddd;"></div>
               <div class="color-box mr-2" style="width: 25px; height: 25px; background-color: #0000ff; border-radius: 50%; border: 1px solid #ddd;"></div>
            </div>
         </div>
      </div>

      <!-- Tallas -->
      <div class="card border-0 mb-2 shadow-sm">
         <div class="card-header " id="headingSize">
            <h2 class="mb-0">
               <button class="btn btn-link  text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseSize" aria-expanded="false" aria-controls="collapseSize">
                  <i class="fa fa-arrows-v"></i> Tallas
               </button>
            </h2>
         </div>
         <div id="collapseSize" class="collapse show" aria-labelledby="headingSize" data-parent="#filterAccordion">
            <div class="card-body">
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="sizeS">
                  <label class="form-check-label" for="sizeS"><i class="fas fa-tshirt"></i> S</label>
               </div>
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="sizeM">
                  <label class="form-check-label" for="sizeM"><i class="fas fa-tshirt"></i> M</label>
               </div>
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="sizeL">
                  <label class="form-check-label" for="sizeL"><i class="fas fa-tshirt"></i> L</label>
               </div>
               <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="sizeXL">
                  <label class="form-check-label" for="sizeXL"><i class="fas fa-tshirt"></i> XL</label>
               </div>
            </div>
         </div>
      </div>
   </div>


            <!--  -->
         </div>
         <div class="col-md-9">
            <div class="row products-grid">
               @forelse($productos as $producto)

               <div class="col-lg-4 col-md-6 col-sm-6 col-6 mb-4">
                  <div class="product-box mt40">
                     <div class="cart-box primary-overlay">
                        <div class="cart-img full-width">
                           <a href="{{route('website.productos.show',$producto->url)}}">
                              <img
                                 src="{{ !is_null($producto->portada) && Storage::disk('public')->exists($producto->portada->url) ? asset('storage/' . $producto->portada->url) : asset('img/imagen-placeholder.png') }}"
                                 alt="{{ $producto->nombre }}">
                           </a>
                        </div>
                     </div>
                     <div class="cart-dtl">
                        <div class="titulo">
                           <h4>{{ $producto->nombre }}</h4>
                        </div>
                        <div class="precio">
                           <span>${{ number_format($producto->precio, 0, ',', '.') }}</span>
                        </div>
                        <div class="btnComprar">
                           <a href="{{route('website.productos.show',$producto->url)}}" class="btnComprarProducto">Comprar</a>
                        </div>
                     </div>
                  </div>
               </div>
               @empty
               <div class="col-12">
                  <div class="empty-state">
                     Muy pronto tendremos productos disponibles. ¡Vuelve pronto!
                  </div>
               </div>
               @endforelse
            </div>
         </div>

      </div>
   </div>
</div>
@endsection
