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
    padding: 150px 0 80px;
}
.shop-bg .section-title h3 {
    color: #fff;
    font-size: 2.5rem;
    font-weight: 900;
    text-transform: uppercase;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.breadcrumb li, .breadcrumb li a { color: #aaa !important; }

/* ÁREA PRINCIPAL */
.product-area.shopping-area {
    background: transparent;
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
.accordion .card {
    background: rgba(20,20,40,0.8) !important;
    border: none !important;
    border-radius: 15px !important;
    margin-bottom: 15px !important;
    backdrop-filter: blur(15px);
    border-left: 4px solid #00f0ff !important;
}
.accordion .card:nth-child(even) {
    border-left-color: #8a2be2 !important;
}
.accordion .card-header {
    background: transparent !important;
    border: none !important;
}
.btn-link {
    color: #fff !important;
    font-weight: 700 !important;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.btn-link:hover { color: #00f0ff !important; text-decoration: none !important; }
.card-body { color: #aaa !important; background: transparent !important; }
.form-check-label { color: #aaa !important; }
.form-check-input { accent-color: #8a2be2; }

/* CARDS DE PRODUCTOS */
.product-box {
    background: rgba(20,20,40,0.8) !important;
    border-radius: 20px !important;
    overflow: hidden;
    border-left: 4px solid #00f0ff;
    backdrop-filter: blur(15px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    transition: 0.3s;
    margin-bottom: 25px;
}
.product-box:nth-child(even) { border-left-color: #8a2be2; }
.product-box:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.5); }

.cart-box .cart-img img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
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
    box-shadow: 0 10px 30px rgba(0,0,0,0.4) !important;
    min-height: 420px !important;
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
    .shop-bg .section-title h3 { font-size: 1.8rem; }
}
</style>
@endpush
@section("title","Tienda Fitness Club Tunja")
@section("content")
<div class="shop-bg page-head parallax overlay">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <h3>Tienda Fitness Club</h3>
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
               <h3>Productos y Equipamiento Fitness</h3>
               <p>Encuentra todo lo que necesitas para potenciar tu entrenamiento</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-3">
            <!--  -->

   <div class="accordion" id="filterAccordion">
      <!-- Categorías -->
      <div class="card border-0 mb-2 shadow-sm">
         <div class="card-header " id="headingCategories">
            <h2 class="mb-0">
               <button class="btn btn-link  text-decoration-none" type="button" data-toggle="collapse" data-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                  <i class="fas fa-tags"></i> Categorías
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
                  <i class="fas fa-dollar-sign"></i> Precio
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
                  <i class="fas fa-palette"></i> Color
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
                  <i class="fas fa-ruler-combined"></i> Tallas
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
            <div class="row">
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