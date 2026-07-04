@extends("website.layouts.app")
@push("page_styles")
@push("page_styles")
<link rel="stylesheet" href="{{url('template/website/assets/css/carrito.css')}}">
<style>
body {
    background: radial-gradient(circle at top, #0f0f1f, #050505) !important;
    color: #fff;
}
.page-head {
    padding: 130px 100px 15px;
}
.shop-cart-bg .section-title h3 {
    color: #fff;
    background: linear-gradient(90deg, #8a2be2, #00f0ff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.breadcrumb li, .breadcrumb li a { color: #aaa !important; }

.cart-main-area { background: transparent; }

.table-content table {
    background: rgba(20,20,40,0.8) !important;
    border-radius: 15px;
    overflow: hidden;
}
.table-content table thead {
    background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
}
.table-content table td,
.table-content table td.product-subtotal,
.table-content table .product-price .amount,
.table-content table td.product-name a {
    color: #fff !important;
}

.cart-btn {
    background: rgba(20,20,40,0.8) !important;
    border-radius: 15px;
}
.cart-btn .btn-coupon input {
    background: rgba(0,0,0,0.3) !important;
    color: #fff !important;
    border: 1px solid rgba(138,43,226,0.4) !important;
}
.cart-btn .btn-coupon a.primary-btn {
    background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
}
.cart-btn .total-update input,
.cart-btn .total-update a.btn-bk {
    background: rgba(0,0,0,0.4) !important;
}
.cart-btn .total-update input:hover,
.cart-btn .total-update a.btn-bk:hover {
    background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
}

.cart-total h3 { color: #fff; }
.cart-total .cart-bg span { color: #ccc !important; }
.cart-total .total {
    background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
}

/* FOOTER de este archivo (independiente del layout) */
.footer-area.bg3 {
    background: radial-gradient(circle at bottom, #0f0f1f, #050505) !important;
}
.footer-area p, .footer-area .news-info .footer-title h3 { color: #fff !important; }
</style>
@endpush
<link rel="stylesheet" href="{{url('template/website/assets/css/carrito.css')}}">
@endpush
@section("title","Tienda Fitness Club Tunja")
@section("content")
<div class="shop-cart-bg page-head parallax overlay">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <h3>Carrito de compras</h3>
            </div>
         </div>
         <div class="col-md-12">
            <ol class="breadcrumb">
               <li><a href="index.html">Inicio</a></li>
               <li>।</li>
               <li>Carrito de compras</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="cart-main-area  pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <form action="#">
               <div class="table-content table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th class="product-thumbnail">Image</th>
                           <th class="product-name">Product</th>
                           <th class="product-price">Price</th>
                           <th class="product-quantity">Quantity</th>
                           <th class="product-subtotal">Total</th>
                           <th class="product-remove">Remove</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="product-thumbnail">
                              <a href="#"><img src="assets/images/price/thumb/1.jpg" alt="Cart img"></a>
                           </td>
                           <td class="product-name"><a href="#">proteina</a></td>
                           <td class="product-price"><span class="amount">$60.00</span></td>
                           <td class="product-quantity"><input type="number" value="1"></td>
                           <td class="product-subtotal">$60.00</td>
                           <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                        <tr>
                           <td class="product-thumbnail">
                              <a href="#"><img src="assets/images/price/thumb/2.jpg" alt="Cart img"></a>
                           </td>
                           <td class="product-name"><a href="#">amino energy</a></td>
                           <td class="product-price"><span class="amount">$120.00</span></td>
                           <td class="product-quantity"><input type="number" value="1"></td>
                           <td class="product-subtotal">$120.00</td>
                           <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                        <tr>
                           <td class="product-thumbnail">
                              <a href="#"><img src="assets/images/price/thumb/3.jpg" alt="Cart img"></a>
                           </td>
                           <td class="product-name"><a href="#">icasin energy</a></td>
                           <td class="product-price"><span class="amount">$40.00</span></td>
                           <td class="product-quantity"><input type="number" value="1"></td>
                           <td class="product-subtotal">$40.00</td>
                           <td class="product-remove"><a href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </form>
            <div class="cart-btn">
               <div class="btn-coupon">
                  <input type="text" placeholder="Coupon Code">
                  <a href="#" class="primary-btn">Apply Coupon</a>
               </div>
               <div class="total-update">
                  <input value="Update Cart" type="submit">
                  <a href="#" class="btn-bk">Proceed To Checkout</a>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="cart-total">
               <h3>CART TOTALS</h3>
               <div class="cart-bg">
                  <span>Subtotal</span>
                  <span class="pull-right">$220.00</span>
                  <div class="total">
                     <span>Total</span>
                     <span class="pull-right">$220.00</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<footer>
   <section class="footer-area bg3 parallax overlay pt90">
      <div class="container">
         <div class="row">
            <div class="col-md-3 col-sm-12 ">
               <div class="footer-logo footer-content">
                  <img src="assets/images/logo/logo2.png" alt="footer logo">
               </div>
               <p>Lorem ipsum dolor sit amet, ei ubique fastidii vim. Elitr feugait complectitur eu pro, sea audire ponderum eleifend cu. Vim at fuisset.</p>
               <div class="add-info">
                  <p><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i></a>23 New Design Street, Melbourne</p>
                  <p><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="bfdddad9d6cbd8c6d2ffd8d2ded6d391dcd0d2">[email&#160;protected]</a></p>
                  <p class="mb-0"><a href="#"><i class="fa fa-mobile" aria-hidden="true"></i></a>+880-123-456-7890</p>
               </div>
            </div>
            <div class="col-md-3 col-sm-12">
               <div class="news-info ftr-algn">
                  <div class="footer-title footer-content">
                     <h3>news letter</h3>
                  </div>
                  <p> sign up for our mailing list to get latest updates and offers</p>
                  <div class="subscribe">
                     <form action="#">
                        <input class="name" type="text" placeholder="Enter your email">
                     </form>
                     <a href="#"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                  </div>
                  <div class="footer-social">
                     <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li><a href=""><i class="fa fa-youtube"></i></a></li>
                        <li><a href=""><i class="fa fa-pinterest"></i></a></li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-12">
               <div class="news-info ftr-algn">
                  <div class="footer-title footer-content">
                     <h3>latest post</h3>
                  </div>
                  <div class="news-detail nws-bar">
                     <img src="assets/images/footer/1.jpg" alt="">
                     <p>Set yourself the challenge of doing the bare minimum.</p>
                  </div>
                  <div class="news-detail">
                     <img src="assets/images/footer/2.jpg" alt="">
                     <p>Body fat percentage: what does it really mean?</p>
                  </div>
                  <div class="news-detail">
                     <img src="assets/images/footer/3.jpg" alt="">
                     <p>This treatment sounded just what I was looking for.</p>
                  </div>
               </div>
            </div>
            <div class="col-md-3 col-sm-12">
               <div class="news-info open-hrs ftr-algn">
                  <div class="footer-title footer-content">
                     <h3>opening hours</h3>
                  </div>
                  <ul>
                     <li>Monday <span>07:00 - 17:00</span></li>
                     <li>tuesday <span>07:00 - 17:00</span></li>
                     <li>wednesday <span>07:00 - 17:00</span></li>
                     <li>thursday <span>07:00 - 17:00</span></li>
                     <li>friday <span>07:00 - 17:00</span></li>
                     <li>saturday <span>07:00 - 17:00</span></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="instra pad60">
                  <h4><span>instragram</span></h4>
               </div>
            </div>
         </div>
      </div>
   </section>
   <div class="footer-gallery owl-carousel">
      <div class="item active"> <a href="assets/images/instagram/big1.jpg">
         <img src="assets/images/instagram/1.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item "><a href="assets/images/instagram/big2.jpg">
         <img src="assets/images/instagram/2.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big3.jpg">
         <img src="assets/images/instagram/3.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big4.jpg">
         <img src="assets/images/instagram/4.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big5.jpg">
         <img src="assets/images/instagram/5.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big6.jpg">
         <img src="assets/images/instagram/6.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big4.jpg">
         <img src="assets/images/instagram/4.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big5.jpg">
         <img src="assets/images/instagram/5.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
      <div class="item"> <a href="assets/images/instagram/big6.jpg">
         <img src="assets/images/instagram/6.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
      </div>
   </div>
   <div class="copyright pad30">
      <h4>Copyright © <span>iThemeslab</span> All Rights Reserved</h4>
   </div>
</footer>
</div>
<div id="search-popup" class="search-popup">
<div class="close-search theme-btn"><span class="fa fa-close"></span></div>
<div class="popup-inner">
   <div class="search-form">
      <form method="post" action="index.html">
         <div class="form-group">
            <fieldset>
               <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required="">
               <input type="submit" value="Search" class="theme-btn">
            </fieldset>
         </div>
      </form>
      <br>
      <h3>Recent Search Keywords</h3>
   </div>
</div>
@endsection
@push("page_scripts")
@endpush