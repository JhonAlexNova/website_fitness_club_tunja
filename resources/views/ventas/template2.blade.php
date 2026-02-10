@extends("layouts.app")

@push("page_css")
<link rel="stylesheet" href="{{ url('css/ventas-template2.css?id=1') }}?id=4">

<!-- Stylesheet -->
    <link href="assets/vendor/animate/animate.css" rel="stylesheet">
    <link href="assets/vendor/magnific-popup/magnific-popup.min.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="assets/vendor/tempus-dominus/css/tempus-dominus.min.css" rel="stylesheet">
	
	<!-- Custom Stylesheet -->
    <link rel="stylesheet" href="assets/vendor/rangeslider/rangeslider.css">
    <link rel="stylesheet" href="assets/vendor/switcher/switcher.css">
    <link rel="stylesheet" href="assets/css/style.css?id=1">
    
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
	<link href="../css2?family=Lobster&family=Lobster+Two:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @php
        $colorPrimary = "#68216F";

    @endphp
    <style>
      .section-wrapper-2 {
    position: relative;
    background-color: rgba(14, 17, 24, 0.97) !important;
}

.dz-img-box.style-2 .dz-media {
    width: 150px;
    min-width: 150px;
    margin: 0 auto 10px;
    border-radius: 50%;
    border: 9px solid #f7f7f7;
    -webkit-transition: all 0.5s;
    -ms-transition: all 0.5s;
    transition: all 0.5s;
    background: #fff;
}

h2.title.wow.flipInX {
    color: #fff;
}

.detail-media.m-b30.portadaProducto {
    max-width: 100px;
    margin: 6px auto 21px;
    border: 1px #77777740 solid;
}
.ti-minus{
    pointer-events:none
}


.btn-primary, .wp-block-button__link {
    border-color: {{$colorPrimary}};
    background-color: {{$colorPrimary}};
}

.dz-img-box.style-2:hover, .dz-img-box.style-2.active {
    border-color: {{$colorPrimary}};
}
.dz-img-box.style-2::before {
    background-color: {{$colorPrimary}};
}

.btnCarritoFixedBottom {
    background: {{$colorPrimary}};
}

.text-primary {
    color: #000000 !important;
}

.site-wrapper {
    border-top: 4px solid {{$colorPrimary}};
}

.fa-close:before, .fa-multiply:before, .fa-remove:before, .fa-times:before, .fa-xmark:before {
    content: "\f00d";
}

.shop-filter {
    padding: 30px 20px;
    position: fixed;
    left: 0;
    top: 0px;
    z-index: 999999999;
    background: #fff;
    height: 100%;
    -webkit-transition: all 0.8s;
    -ms-transition: all 0.8s;
    transition: all 0.8s;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.2);
    width: 300px;
    overflow: scroll;
}

.shop-filter.style-1.openCarrito {
    left: 0 !important;
}

    </style>
@endpush

@section("content")
<main class="site-wrapper">
  <div class="pt-table desktop-768">
    <div class="pt-tablecell page-home relative" style="background-image: url(https://images.unsplash.com/photo-1486870591958-9b9d0d1dda99?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80);
    background-position: center;
    background-size: cover;">
                    <div class="overlay"></div>

                  

                   <!--  -->
                   <section class="content-inner bg-white section-wrapper-2 overflow-hidden">
                        <div class="container">
                            <div class="section-head text-center">
                                <h2 class="title wow flipInX" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: flipInX;">Menu</h2>
                            </div>
                            <div class="row" id='productosCategorias'>
                                
                            </div>
                        </div>
                        <img class="bg1 dz-move-down" src="assets/images/background/pic2.png" alt="/">
                        <img class="bg2 dz-parallax" data-parallax-speed="0.05" src="assets/images/background/pic3.png" alt="/" style="transform: translate3d(0px, -49px, 0px) rotate(-49deg);">
                    </section>


                    

                   <!--  -->

                   <section id="s-productos">
                        <div class="row"></div>
                   </section>
                   <!--  -->
                   <aside class="side-bar sticky-top">
   <div class="shop-filter style-1">
       <div class="d-flex justify-content-between">
           <div class="widget-title">
               <h5 class="title m-b30">Carrito <span class="text-primary">(03)</span></h5>
           </div>
           <a href="javascript:void(0);" class="panel-close-btn"><i class="fa-solid fa-xmark"></i></a>
       </div>
       <div class="listaCarrito">

       </div>
      
       <div class="order-detail">
           <h6>Detalles de la Factura</h6>
           <table>
               <tbody>
                  
                   <tr class="total">
                       <td><h6>Total</h6></td>
                       <td class="price total-factura text-primary"></td>
                   </tr>
               </tbody>
           </table>
           <a href="javascript:void(0);" class="btn btn-primary d-block text-center btn-md w-100 btn-hover-1 btnFinalizar">
                <span>Ordenar Ahora <i class="fa-solid fa-arrow-right"></i></span>
            </a>
       </div>
   </div>
</aside>

                   <!--  -->
                </div>
            </div>

            <!--  -->
              <!-- modal detalle producto -->

            <!--  -->
  </main>


    <!-- Modal -->
    <div class="modal fade" id="modalDetailsProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalles producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!--  -->
            <section class="content-inner-1 overflow-hidden">
                        <div class="container">
                            <div class="row product-detail">
                                <div class="col-lg-4 col-md-5">
                                    <div class="detail-media m-b30 portadaProducto">
                                        <img src="" alt="/">
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-7">
                                    <div class="detail-info">
                                        <span class="badge">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.5" y="0.5" width="16" height="16" stroke="#0F8A65"></rect>
                                            <circle cx="8.5" cy="8.5" r="5.5" fill="#0F8A65"></circle>
                                            </svg>
                                            
                                        </span>
                                        <div class="dz-head">
                                            <h2 class="title"></h2>
                                            <div class="rating">
                                                <!-- <i class="fa-solid fa-star"></i> <span><strong class="text-dark">4.5</strong> - 20 Reviews</span> -->
                                            </div>
                                        </div>
                                        <p class="text"></p>
                                        <ul class="detail-list">
                                            <li>Precio <span class="text-primary m-t5 precio"></span></li>
                                            <li>Cantidad
                                                <div class="btn-quantity style-1 m-t5">
                                                    <div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
                                                    <input id="demo_vertical2" type="text" value="1" name="cantidad" class="form-control" style="display: block;">
                                                    <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span><span class="input-group-btn-vertical">
                                                        <button class="btn btn-default bootstrap-touchspin-up" type="button"><i class="ti-plus"></i></button><button class="btn btn-default bootstrap-touchspin-down" type="button"><i class="ti-minus"></i></button>
                                                    </span>
                                                </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h6 class="title"></h6>
                                        <ul class="add-product">
                                           <!--  <li><div class="mini-modal">
                                                    <div class="dz-media ">
                                                        <img src="" alt="assets/images/modal/mini/pic2.jpg">
                                                    </div>
                                                    <div class="dz-content">
                                                        <p class="title">French Frise</p>
                                                        <div class="form-check search-content">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> -->
                                           <!--  <li><div class="mini-modal">
                                                    <div class="dz-media">
                                                        <img src="assets/images/modal/mini/pic2.jpg" alt="/">
                                                    </div>
                                                    <div class="dz-content">
                                                        <p class="title">Extra Cheese</p>
                                                        <div class="form-check search-content">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><div class="mini-modal">
                                                    <div class="dz-media">
                                                        <img src="assets/images/modal/mini/pic3.jpg" alt="/">
                                                    </div>
                                                    <div class="dz-content">
                                                        <p class="title">Coca Cola</p>
                                                        <div class="form-check search-content">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li><div class="mini-modal">
                                                    <div class="dz-media">
                                                        <img src="assets/images/modal/mini/pic4.jpg" alt="/">
                                                    </div>
                                                    <div class="dz-content">
                                                        <p class="title">Choco Lava</p>
                                                        <div class="form-check search-content">
                                                            <input class="form-check-input" type="checkbox" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> -->
                                        </ul>
                                        <div class="d-lg-flex justify-content-between">
                                            <!-- <ul class="modal-btn-group">
                                                <li><a href="shop-cart.html" class="btn btn-primary btn-hover-1"><span>Add To Cart <i class="flaticon-shopping-bag-1 m-l10"></i></span></a></li>
                                                <li><a href="shop-checkout.html" class="btn btn-outline-secondary btn-hover-1"><span>Buy Now <i class="flaticon-shopping-cart m-l10"></i></span></a></li>
                                            </ul> -->
                                           <!--  <ul class="avatar-list avatar-list-stacked">
                                                <li class="avatar"><img src="assets/images/testimonial/small/pic1.jpg" alt=""></li>
                                                <li class="avatar"><img src="assets/images/testimonial/small/pic2.jpg" alt=""></li>
                                                <li class="avatar"><img src="assets/images/testimonial/small/pic3.jpg" alt=""></li>
                                                <li class="avatar"><img src="assets/images/testimonial/small/pic4.jpg" alt=""></li>
                                                <li class="avatar"><img src="assets/images/testimonial/small/pic5.jpg" alt=""></li>
                                                <li class="avatar"><span>150+</span></li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </section>
            <!--  -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnAgregarProductoCarrito">Confirmar</button>
        </div>
        </div>
    </div>
    </div>


    <!--  -->
    
    <!--  -->
    <a href="javascript:void(0);" class="btnCarritoFixedBottom">
        ver carrito
    </a>


@endsection

@push('page_scripts')
<script src="{{url('js/producto.js')}}?id=5"></script>
<script src="{{url('js/ventas2.js')}}?id=1"></script>
<script>
    const body = document.body;
    // Agrega la clase sidebar-collapse al body al cargar la página
    body.classList.add("sidebar-collapse");
    document.addEventListener("DOMContentLoaded", function () {
  });
  
    window.onload = async function(){
        var productos = await getAllProductos();
        var producto = {};
        var htmlListProductos = '';
            for(var producto of productos){
                htmlListProductos+=`
                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <div class="dz-img-box style-2 box-hover">
                            <div class="dz-media">
                                <img src="storage/${producto.icono}" alt="/">
                            </div>
                            <div class="dz-content">
                                <h4 class="dz-title"><a href="javascript:void(0);">${producto.nombre}</a></h4>
                                <p>${producto.descripcion}.</p>
                                <h5 class="dz-price text-primary">$${numberFormat(producto.historial_precio.precio_venta)}</h5>
                                <a  class="btn btn-primary btn-hover-2 btnAddProduct" producto_id="${producto.id}">Agregar</a>
                            </div>
                        </div>
                    </div>
                `;
            }
            $('#productosCategorias').html(htmlListProductos);
    }


    $(document).on('click','.btnAddProduct',async function(event){
        var id = $(this).attr('producto_id');
        producto = await getProductosById(id);
        $('#modalDetailsProduct h2').html(producto.nombre);
        $('#modalDetailsProduct .text').html(producto.descripcion);
        $('#modalDetailsProduct .portadaProducto img').attr('src',`storage/${producto.icono}`);
        $('#modalDetailsProduct .precio').html('$'+ numberFormat(producto.historial_precio.precio_venta));


        
        $('#modalDetailsProduct').modal('show');
    });
   
</script>
@endpush