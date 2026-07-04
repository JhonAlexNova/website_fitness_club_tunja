<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>@yield('title',"Fitness Club Tunja")</title>
      <meta name="author" content="Fitness Club Tunja">
      <meta name="description" content="Fitness Club Tunja - Tu gimnasio en Tunja, Boyacá">
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
            background: #1a3cff;
            position: revert-layer;
            height: fit-content;
            line-height: 0 !important;
            padding: 18px 10px 19px 11px !important;
            margin: 22px 0 0 0;
            border-radius: 3px;
         }

         /* ── FOOTER MEJORADO ── */
         .footer-area-custom {
            background: #1a1a1a;
            color: #ccc;
            padding: 60px 0 30px;
         }

         .footer-area-custom .footer-brand img {
            max-width: 110px;
            margin-bottom: 15px;
         }

         .footer-area-custom .footer-desc {
            font-size: 14px;
            line-height: 1.8;
            color: #aaa;
            margin-bottom: 20px;
         }

         .footer-area-custom .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 14px;
            color: #ccc;
         }

         .footer-area-custom .footer-contact-item i {
            color: #1a3cff;
            font-size: 16px;
            margin-top: 2px;
            min-width: 18px;
         }

         .footer-area-custom .footer-section-title {
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a3cff;
            display: inline-block;
         }

         .footer-area-custom .footer-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
         }

         .footer-area-custom .footer-links ul li {
            margin-bottom: 10px;
         }

         .footer-area-custom .footer-links ul li a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
         }

         .footer-area-custom .footer-links ul li a:hover {
            color: #1a3cff;
         }

         .footer-area-custom .footer-links ul li a i {
            margin-right: 8px;
            color: #1a3cff;
            font-size: 12px;
         }

         .footer-area-custom .opening-hours ul {
            list-style: none;
            padding: 0;
            margin: 0;
         }

         .footer-area-custom .opening-hours ul li {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #aaa;
            padding: 6px 0;
            border-bottom: 1px solid #2e2e2e;
         }

         .footer-area-custom .opening-hours ul li:last-child {
            border-bottom: none;
         }

         .footer-area-custom .opening-hours ul li span {
            color: #1a3cff;
            font-weight: 600;
         }

         .footer-area-custom .social-links {
            display: flex;
            gap: 10px;
            margin-top: 20px;
         }

         .footer-area-custom .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #2e2e2e;
            color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: background 0.3s, color 0.3s;
            text-decoration: none;
         }

         .footer-area-custom .social-links a:hover {
            background: #1a3cff;
            color: #fff;
         }

         .footer-area-custom .footer-divider {
            border-color: #2e2e2e;
            margin: 30px 0 20px;
         }

         .footer-area-custom .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
         }

         .footer-area-custom .footer-bottom p {
            font-size: 13px;
            color: #777;
            margin: 0;
         }

         .footer-area-custom .footer-bottom a {
            color: #1a3cff;
            text-decoration: none;
         }

         .footer-gallery-section {
            background: #111;
         }

         @media (max-width: 768px) {
            .footer-area-custom .col-md-3,
            .footer-area-custom .col-md-4 {
               margin-bottom: 35px;
            }
            .footer-area-custom .footer-bottom {
               justify-content: center;
               text-align: center;
            }
         }
      </style>

      @stack("page_styles")
      <!--[if lt IE 9]>
      <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
   </head>
   <body>
      <div class="main-container">
         <header class="header fixed-top">
            @include("website.layouts.menu")
         </header>

         @yield("content")

         <footer>

            <!-- ══ GALERÍA INSTAGRAM ══ -->
            <div class="footer-gallery-section">
               <div class="container-fluid px-0">
                  <div class="footer-gallery owl-carousel">
                     <div class="item active">
                        <a href="{{url('template/website/assets/images/instagram/big1.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/1.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big2.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/2.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big3.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/3.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big4.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/4.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big5.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/5.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big6.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/6.jpg')}}" alt="Instagram Fitness Club">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>

            <!-- ══ FOOTER PRINCIPAL ══ -->
            <div class="footer-area-custom">
               <div class="container">
                  <div class="row">

                     <!-- Columna 1: Logo + Descripción + Contacto -->
                     <div class="col-md-4 col-sm-12 mb-4">
                        <div class="footer-brand">
                           <img src="{{url('img/logo10.png')}}" alt="Fitness Club Tunja">
                        </div>
                        <p class="footer-desc">
                           Tu gimnasio en el corazón de Tunja. Entrenamiento profesional, planes personalizados y el ambiente ideal para alcanzar tus metas.
                        </p>
                        <div class="footer-contact-item">
                           <i class="fa fa-map-marker"></i>
                           <span>Tunja, Boyacá — Colombia</span>
                        </div>
                        <div class="footer-contact-item">
                           <i class="fa fa-phone"></i>
                           <span>+57 321 497 8403</span>
                        </div>
                        <div class="footer-contact-item">
                           <i class="fa fa-envelope-o"></i>
                           <span>fitnessclubtunja@gmail.com</span>
                        </div>
                        <div class="social-links">
                           <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                           <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
                           <a href="#" title="YouTube"><i class="fa fa-youtube"></i></a>
                           <a href="#" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                        </div>
                     </div>

                     <!-- Columna 2: Links rápidos -->
                     <div class="col-md-2 col-sm-6 mb-4">
                        <h5 class="footer-section-title">Navegación</h5>
                        <div class="footer-links">
                           <ul>
                              <li><a href="{{ url('/') }}"><i class="fa fa-angle-right"></i> Inicio</a></li>
                              <!--<li><a href="{{ url('tienda') }}"><i class="fa fa-angle-right"></i> Tienda</a></li>-->
                              <li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Membresías</a></li>
                              <li><a href="#contacto"><i class="fa fa-angle-right"></i> Contacto</a></li>
                              <!--<li>
                                 @guest
                                    <a href="{{ route('login') }}"><i class="fa fa-angle-right"></i> Acceder</a>
                                 @else
                                    <a href="{{ url('app') }}"><i class="fa fa-angle-right"></i> Mi Cuenta</a>
                                 @endguest
                              </li>-->
                           </ul>
                        </div>
                     </div>

                     <!-- Columna 3: Planes -->
                     <div class="col-md-2 col-sm-6 mb-4">
                        <h5 class="footer-section-title">Membresías</h5>
                        <div class="footer-links">
                           <ul>
                              <li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Membresías</a></li>
                              <!--<li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Trimestral</a></li>
                              <li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Semestral</a></li>
                              <li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Anual</a></li>-->
                           </ul>
                        </div>
                     </div>

                     <!-- Columna 4: Horarios -->
                     <div class="col-md-4 col-sm-12 mb-4">
                        <h5 class="footer-section-title">Horarios</h5>
                        <div class="opening-hours">
                           <ul>
                              <li>Lunes <span>06:00 AM - 11:00 AM / 04:00 PM - 09:00 PM</span></li>
                              <li>Martes <span>06:00 AM - 11:00 AM / 04:00 PM - 09:00 PM</span></li>
                              <li>Miércoles <span>06:00 AM - 11:00 AM / 04:00 PM - 09:00 PM</span></li>
                              <li>Jueves <span>06:00 AM - 11:00 AM / 04:00 PM - 09:00 PM</span></li>
                              <li>Viernes <span>06:00 AM - 11:00 AM / 04:00 PM - 09:00 PM</span></li>
                              <li>Sábado <span>07:00 AM - 12:00 PM</span></li>
                              <li>Domingo <span>08:00 AM - 12:00 PM</span></li>
                           </ul>
                        </div>
                     </div>

                  </div><!-- /.row -->

                  <hr class="footer-divider">

                  <div class="footer-bottom">
                     <p>© {{ date('Y') }} <strong style="color:#fff">Fitness Club Tunja</strong>. Todos los derechos reservados.</p>
                     <p>Tunja, Boyacá — Colombia</p>
                  </div>

               </div><!-- /.container -->
            </div><!-- /.footer-area-custom -->

         </footer>
      </div>

      <!-- Search popup -->
      <div id="search-popup" class="search-popup">
         <div class="close-search theme-btn"><span class="fa fa-close"></span></div>
         <div class="popup-inner">
            <div class="search-form">
               <form method="post" action="index.html">
                  <div class="form-group">
                     <fieldset>
                        <input type="search" class="form-control" name="search-input" value="" placeholder="Buscar..." required="">
                        <input type="submit" value="Buscar" class="theme-btn">
                     </fieldset>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <script src="{{url('template/website/assets/js/vendor/jquery-3.2.1.min.js')}}"></script>
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
                     t = 9999, r = 0, n = 0, l = 0, f = 0, s = 0, h = 0;
                 if (e.responsiveLevels && (jQuery.each(e.responsiveLevels, function(e, f) {
                         f > i && (t = r = f, l = e), i > f && f > r && (r = f, n = e)
                     }), t > r && (l = n)),
                     f = e.gridheight[l] || e.gridheight[0] || e.gridheight,
                     s = e.gridwidth[l] || e.gridwidth[0] || e.gridwidth,
                     h = i / s, h = h > 1 ? 1 : h, f = Math.round(h * f),
                     "fullscreen" == e.sliderLayout) {
                     var u = (e.c.width(), jQuery(window).height());
                     if (void 0 != e.fullScreenOffsetContainer) {
                         var c = e.fullScreenOffsetContainer.split(",");
                         if (c) jQuery.each(c, function(e, i) {
                             u = jQuery(i).length > 0 ? u - jQuery(i).outerHeight(!0) : u
                         }), e.fullScreenOffset.split("%").length > 1 && void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0
                             ? u -= jQuery(window).height() * parseInt(e.fullScreenOffset, 0) / 100
                             : void 0 != e.fullScreenOffset && e.fullScreenOffset.length > 0 && (u -= parseInt(e.fullScreenOffset, 0))
                     }
                     f = u
                 } else void 0 != e.minHeight && f < e.minHeight && (f = e.minHeight);
                 e.c.closest(".rev_slider_wrapper").css({ height: f })
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