@extends("website.layouts.app")
@push("page_styles")
<link rel="stylesheet" href="{{url('template/website/assets/css/tienda.css')}}">
<style>
   .card.border-0.mb-2.shadow-sm {
    border: 1px #eaeaea solid !important;
}
.mb-0, .my-0 {
    margin-bottom: 0!important;
    border: .card.border-0.mb-2.shadow-sm;
    border-bottom: 1px #eaeaea solid;
}

.btn-link {
    font-weight: 400;
    color: #000;
    background-color: transparent;
    font-weight: bold;
}
.mt40 {
    margin-top: 0;
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
               <li><a href="index.html">Inicio</a></li>
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
               <div class="title-bar full-width mb20">
                  <img src="{{url('template/website/assets/images/logo/ttl-bar.png')}}" alt="title-img">
               </div>
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
               @foreach($productos as $producto)
               
               <div class="col-lg-4 col-md-6 col-sm-6 col-xs-4 form-group">
                  <div class="product-box mt40">
                     <div class="cart-box primary-overlay">
                        <div class="cart-img full-width">
                           <a href="assets/images/price/big12.jpg')}}">
                           <img src="{{ !is_null($producto->portada)?url('storage',$producto->portada->url):url('img/imagen-placeholder.png') }}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                        </div>
                       
                     </div>
                     <div class="cart-dtl">
                        <div class="titulo">
                           <h4>{{ $producto->nombre }} </h4>
                        </div>
                        <div class="precio">
                           <span>£10.00</span>
                        </div>
                        <div class="btnComprar">
                           <a href="{{route('website.productos.show',$producto->url)}}" class="btnComprarProducto">Comprar</a>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>

      </div>
   </div>
</div>
@endsection