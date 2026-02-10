<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title',"Fitness Club Tunja")</title>
      <meta name="author" content="iThemesLab">
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="shortcut icon" href="{{url('template/website/assets/favicon/favicon.ico')}}">
      <link rel="apple-touch-icon" href="{{url('template/website/assets/favicon/apple-icon-57x57.png')}}">
      <link rel="apple-touch-icon" sizes="72x72" href="{{url('template/website/assets/favicon/apple-icon-72x72.png')}}">
      <link rel="apple-touch-icon" sizes="114x114" href="{{url('template/website/assets/favicon/apple-icon-114x114.png')}}">
      <link rel="apple-touch-icon" sizes="144x144" href="{{url('template/website/assets/favicon/apple-icon-144x144.png')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/bootstrap.min.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/rev_slider/settings.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/rev_slider/navigation.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/flaticon.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/owl.carousel.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/animate.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/magnific-popup.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/vendor/jquery-ui.min.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/style.css')}}">
      <link rel="stylesheet" href="{{url('template/website/assets/css/responsive.css')}}">
      <script src="{{url('template/website/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

      <style>
         li.nav-item.btnLogin a {
    background: #E91E63;
    /* max-height: 66px; */
    position: revert-layer;
    height: fit-content;
    line-height: 0 !important;
    padding: 18px 10px 19px 11px !important;
    margin: 22px 0 0 0;
    border-radius: 3px;
}
      </style>

      @stack("page_styles")
      <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')}}"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js')}}"></script>
      <![endif]-->
   </head>
   <body>
      <div class="main-container">
         <header class="header fixed-top">
            @include("website.layouts.menu")
         </header>
         @yield("content")
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
                           <p><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="f1939497988596889cb1969c90989ddf929e9c">[email&#160;protected]</a></p>
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
               <div class="item active"><a href="{{url('template/website/assets/images/instagram/big1.jpg')}}">
                  <img src="assets/images/instagram/1.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item "><a href="{{url('template/website/assets/images/instagram/big2.jpg')}}">
                  <img src="assets/images/instagram/2.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big3.jpg')}}">
                  <img src="assets/images/instagram/3.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big4.jpg')}}">
                  <img src="assets/images/instagram/4.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big5.jpg')}}">
                  <img src="assets/images/instagram/5.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big6.jpg')}}">
                  <img src="assets/images/instagram/6.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big4.jpg')}}">
                  <img src="assets/images/instagram/4.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big5.jpg')}}">
                  <img src="assets/images/instagram/5.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
               <div class="item"> <a href="{{url('template/website/assets/images/instagram/big6.jpg')}}">
                  <img src="assets/images/instagram/6.jpg" alt="Instragram img"><i class="fa fa-search"></i></a>
               </div>
            </div>
            <div class="copyright pad30">
               <h4>Copyright © <span>iThemeslab.</span> All Rights Reserved</h4>
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
      </div>
      <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script><script src="{{url('template/website/assets/js/vendor/jquery-3.2.1.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/jquery-migrate.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/popper-1.12.3.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/bootstrap.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/owl.carousel.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/jquery.counterup.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/waypoints-jquery.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/isotope.pkgd.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/jquery.themepunch.tools.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/jquery.themepunch.revolution.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.actions.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.carousel.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.kenburn.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.layeranimation.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.migration.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.navigation.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.parallax.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.slideanims.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/rev_slider/extensions/revolution.extension.video.min.js')}}"></script>
      <script type="text/javascript">
         function setREVStartSize(e) {
             try {
                 var i = jQuery(window).width(),
                     t = 9999,
                     r = 0,
                     n = 0,
                     l = 0,
                     f = 0,
                     s = 0,
                     h = 0;
                 if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                         f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                     }), t > r && (l = n)), f = e.gridheight[l] || e.gridheight[0] || e.gridheight, s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth, h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f), "fullscreen" == e.sliderLayout) {
                     var u = (e.c.width(), jQuery(window).height());
                     if (void 0 != e.fullScreenOffsetContainer) {
                         var c = e.fullScreenOffsetContainer.split(",");
                         if (c) jQuery.each(c, function(e, i) {
                             u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                         }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100 : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                     }
                     f = u
                 } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                 e.c.closest(".rev_slider_wrapper").css({
                     height: f
                 })
             } catch (d) {
                 console.log("Failure at Presize of Slider:" + d)
             }
         };
         
      </script>
      <script src="{{url('template/website/assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/jquery.scrollUp.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/jquery-ui.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/vendor/wow.min.js')}}"></script>
      <script src="{{url('template/website/assets/js/main.js')}}"></script>
      @stack("page_scripts")
   </body>
</html>