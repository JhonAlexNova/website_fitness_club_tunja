@extends("website.layouts.app")
@push("page_styles")
 <!-- Owl Stylesheets -->
<link rel="stylesheet" href="{{url('libs/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{url('libs/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="{{url('template/website/assets/css/producto-interno.css')}}">
@endpush
@section("title","Tienda Fitness Club Tunja")
@section("content")
   
   <!--<div class="shop-bg page-head parallax overlay">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="section-title text-center">
                  <h3>{{$producto->nombre}}</h3>
               </div>
            </div>
            
         </div>
      </div>
   </div>-->
   <div class="single-information-area pad90">
      <div class="container">
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
               <!--  -->
               <div class="single-pro-tab-content">
                  <div class="tab-content">
                     <div id="level0" class="tab-pane fade active show">
                           <a href="#"><img src="{{ !is_null($producto->portada) ? url('storage', $producto->portada->url) : url('img/imagen-placeholder.png') }}" alt="thumb img"></a>
                     </div>
                     @foreach($producto->galeria as $index => $imagen)
                     <div id="level{{ $index + 1 }}" class="tab-pane fade">
                           <a href="#"><img src="{{ url('storage', $imagen->url) }}" alt="thumb img"></a>
                     </div>
                     @endforeach
                  </div>
                  
                  <ul id="single-product-tab" class="nav single-product-tab owl-carousel">
                     <li class="nav-item">
                           <a href="#" data-target="#level0" data-toggle="tab" class="nav-link small text-uppercase active">
                              <img src="{{ !is_null($producto->portada) ? url('storage', $producto->portada->url) : url('img/imagen-placeholder.png') }}" alt="product img">
                           </a>
                     </li>
                     @foreach($producto->galeria as $index => $imagen)
                     <li class="nav-item">
                           <a href="#" data-target="#level{{ $index + 1 }}" data-toggle="tab" class="nav-link small text-uppercase">
                              <img src="{{ url('storage', $imagen->url) }}" alt="product img">
                           </a>
                     </li>
                     @endforeach
                  </ul>
               </div>

               <!--  -->
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
               <div class="product-info ">
                  <h3><a href="#"> {{ $producto->nombre }} </a></h3>
                  <div class="pro-rating mt20">
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <div class="review">
                        <p>4 reviews (s) | ass your review</p>
                     </div>
                  </div>
                  <div class="pro-price">
                     <p><span>${{ number_format($producto->precio_venta) }}</span></p>
                  </div>
                  <div class="stock mt10">
                     <p><i class="fa fa-bars"></i>Only 15 left 3 | Availalbe: In Stock</p>
                  </div>
                  <div class="product-desc">
                    {!!  $producto->descripcion !!}
                  </div>
                  <div class="product-action mt30">
                     <form action="#">
                        <div class="cart-plus-minus">
                           <input type="text" value="1" id="cantidad"></div>
                     </form>
                     <div class="pro-button-top">
                        <a href="javascript:void(0);" onclick="addToCart('{{$producto->nombre}}', {{$producto->precio_venta}})">Agregar al carrito</a>
                     </div>
                  </div>
                  <div class="category mt30">
                     <!-- <p>sku :<span>11F25a3678</span></p> -->
                     <!-- <ul>
                        <li>share :</li>
                        <li><a href="#"><i class="fa fa-facebook-official"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                     </ul> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="pro-list-tab" style="display:none">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="pro-list">
                  <ul id="tabsJustified" class="nav">
                     <li class="nav-item"><a href="#" data-target="#label" data-toggle="tab" class="nav-link small text-uppercase active">product descripton</a></li>
                     <li class="nav-item"><a href="#" data-target="#label2" data-toggle="tab" class="nav-link small text-uppercase"> Reviews</a></li>
                     <li class="nav-item"><a href="#" data-target="#label3" data-toggle="tab" class="nav-link small text-uppercase">tags</a></li>
                     <li class="nav-item"><a href="#" data-target="#label4" data-toggle="tab" class="nav-link small text-uppercase"> additional information</a></li>
                     <li class="nav-item"><a href="#" data-target="#label5" data-toggle="tab" class="nav-link small text-uppercase">custom tab info</a></li>
                     <li class="nav-item"><a href="#" data-target="#label6" data-toggle="tab" class="nav-link small text-uppercase"> custom tab video</a></li>
                  </ul>
                  <div class="tab-content">
                     <div id="label" class="tab-pane fade active show">
                        <p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                        <ul>
                           <li><i class="fa fa-circle-thin"></i>Length: 74cm</li>
                           <li><i class="fa fa-circle-thin"></i>Regular fit</li>
                           <li><i class="fa fa-circle-thin"></i>Notched lapels</li>
                           <li><i class="fa fa-circle-thin"></i>Twin button front fastening</li>
                           <li><i class="fa fa-circle-thin"></i>Front patch pockets; chest pocket</li>
                           <li><i class="fa fa-circle-thin"></i>Internal pockets</li>
                           <li><i class="fa fa-circle-thin"></i>Centre-back vent</li>
                           <li><i class="fa fa-circle-thin"></i>Please refer to the garment for care instructions.</li>
                           <li><i class="fa fa-circle-thin"></i>Length: 74cm.</li>
                           <li><i class="fa fa-circle-thin"></i>Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                        </ul>
                     </div>
                     <div id="label2" class="tab-pane fade">
                        <p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                        <br>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid officiis, assumenda corrupti! Sit delectus iusto quidem beatae, nostrum excepturi voluptatem necessitatibus nam dicta illum. Ullam qui, sed error praesentium consectetur!</p>
                     </div>
                     <div id="label3" class="tab-pane fade">
                        <ul>
                           <li><i class="fa fa-circle-thin"></i>Length: 74cm</li>
                           <li><i class="fa fa-circle-thin"></i>Regular fit</li>
                           <li><i class="fa fa-circle-thin"></i>Notched lapels</li>
                           <li><i class="fa fa-circle-thin"></i>Twin button front fastening</li>
                           <li><i class="fa fa-circle-thin"></i>Front patch pockets; chest pocket</li>
                           <li><i class="fa fa-circle-thin"></i>Internal pockets</li>
                           <li><i class="fa fa-circle-thin"></i>Centre-back vent</li>
                           <li><i class="fa fa-circle-thin"></i>Please refer to the garment for care instructions.</li>
                           <li><i class="fa fa-circle-thin"></i>Length: 74cm.</li>
                           <li><i class="fa fa-circle-thin"></i>Material: Outer: 50% Linen & 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
                        </ul>
                     </div>
                     <div id="label4" class="tab-pane fade">
                        <p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper your after-dark wardrobe. <br> Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                     </div>
                     <div id="label5" class="tab-pane fade">
                        <p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper your after-dark wardrobe. <br> Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. <br> He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                     </div>
                     <div id="label6" class="tab-pane fade">
                        <p>NO VIDEO AVAILAVLE</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="product-area pad90" style="display:none">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="section-title text-center">
                  <div class="title-bar full-width mb20">
                     <img src="assets/images/logo/ttl-bar.png" alt="title-img">
                  </div>
                  <h3>related products</h3>
                  <p>look your best feel even better</p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="product-carousel">
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big1.jpg">
                              <img src="assets/images/price/1.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class=" fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>Muscle Gain<span>£85.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big2.jpg">
                              <img src="assets/images/price/2.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class="fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>supplements <span>£75.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big3.jpg">
                              <img src="assets/images/price/3.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class="fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>supplements <span>£95.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big4.jpg">
                              <img src="assets/images/price/4.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class="fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>Muscle Gain<span>£85.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big3.jpg">
                              <img src="assets/images/price/3.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class="fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>supplements <span>£95.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="product-box">
                        <div class="cart-box primary-overlay">
                           <div class="cart-img full-width">
                              <a href="assets/images/price/big4.jpg">
                              <img src="assets/images/price/4.jpg" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
                           </div>
                           <div class="cart-element">
                              <a href="#">quick look</a>
                              <i class="fa fa-heart"></i>
                           </div>
                        </div>
                        <div class="cart-dtl">
                           <h4>Muscle Gain<span>£85.00</span></h4>
                           <div class="add-cart">
                              <a href="#">add to cart</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   
   

@endsection

@push("page_scripts")
   <script src="{{url('libs/OwlCarousel2-2.3.4/dist/owl.carousel.js')}}"></script>
   <script src="{{url('template/website/assets/js/carrito.js')}}"></script>
   <script>
      var owl = $('.single-product-tab');
      owl.owlCarousel({
        margin: 0,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      })
    </script>

@endpush