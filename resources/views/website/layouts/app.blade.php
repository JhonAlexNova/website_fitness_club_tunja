<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      @php
         $seoTitle = trim($__env->yieldContent('title')) ?: 'Fitness Club Tunja';
         $seoDescription = trim($__env->yieldContent('seo_description')) ?: 'Fitness Club Tunja: gimnasio, entrenamiento y membresías en Tunja, Boyacá.';
         $seoCanonical = trim($__env->yieldContent('seo_canonical')) ?: url()->current();
         $seoImage = trim($__env->yieldContent('seo_image')) ?: url('img/logo10.png');
         $seoType = trim($__env->yieldContent('seo_type')) ?: 'website';
         $seoRobots = trim($__env->yieldContent('seo_robots')) ?: 'index,follow';
         $seoSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
               [
                  '@type' => 'ExerciseGym',
                  '@id' => url('/') . '#gym',
                  'name' => 'Fitness Club Tunja',
                  'url' => url('/'),
                  'logo' => url('img/logo10.png'),
                  'image' => $seoImage,
                  'telephone' => '+57 321 497 8403',
                  'email' => 'fitnessclubtunja@gmail.com',
                  'address' => [
                     '@type' => 'PostalAddress',
                     'addressLocality' => 'Tunja',
                     'addressRegion' => 'Boyacá',
                     'addressCountry' => 'CO'
                  ]
               ],
               [
                  '@type' => 'WebSite',
                  '@id' => url('/') . '#website',
                  'url' => url('/'),
                  'name' => 'Fitness Club Tunja',
                  'inLanguage' => 'es-CO'
               ]
            ]
         ];
      @endphp
      <title>{{ $seoTitle }}</title>
      <meta name="description" content="{{ $seoDescription }}">
      <meta name="robots" content="{{ $seoRobots }}">
      <link rel="canonical" href="{{ $seoCanonical }}">
      <meta property="og:locale" content="es_CO">
      <meta property="og:type" content="{{ $seoType }}">
      <meta property="og:title" content="{{ $seoTitle }}">
      <meta property="og:description" content="{{ $seoDescription }}">
      <meta property="og:url" content="{{ $seoCanonical }}">
      <meta property="og:site_name" content="Fitness Club Tunja">
      <meta property="og:image" content="{{ $seoImage }}">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:title" content="{{ $seoTitle }}">
      <meta name="twitter:description" content="{{ $seoDescription }}">
      <meta name="twitter:image" content="{{ $seoImage }}">
      <meta name="theme-color" content="#050505">
      <script type="application/ld+json">{!! json_encode($seoSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
      <!-- Google tag (gtag.js) -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=G-FFWX0NG1BE"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', 'G-FFWX0NG1BE');
      </script>
      <meta name="author" content="Fitness Club Tunja">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="shortcut icon" href="{{url('template/website/assets/favicon/favicon.ico')}}">
      <link rel="apple-touch-icon" href="{{url('template/website/assets/favicon/apple-icon-57x57.png')}}">
      <link rel="apple-touch-icon" sizes="72x72" href="{{url('template/website/assets/favicon/logo8.png')}}">
      <link rel="apple-touch-icon" sizes="114x114" href="{{url('template/website/assets/favicon/logo8.png')}}">
      <link rel="apple-touch-icon" sizes="144x144" href="{{url('template/website/assets/favicon/logo8.png')}}">
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
         /* El contenido público debe adaptarse al viewport sin crear scroll horizontal. */
         html,
         body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
         }

         *,
         *::before,
         *::after {
            box-sizing: border-box;
         }

         html {
            scroll-behavior: smooth;
            scroll-padding-top: 96px;
         }

         body {
            overflow-x: hidden;
            background: #050505;
         }

         .main-container {
            width: 100%;
            overflow-x: hidden;
         }

         .main-container img {
            max-width: 100%;
            height: auto;
         }

         .main-container iframe,
         .main-container video,
         .main-container svg,
         .main-container canvas {
            max-width: 100%;
         }

         .main-container .row,
         .main-container [class*="col-"] {
            min-width: 0;
         }

         .main-container a,
         .main-container p,
         .main-container li,
         .main-container h1,
         .main-container h2,
         .main-container h3,
         .main-container h4,
         .main-container h5,
         .main-container h6 {
            overflow-wrap: anywhere;
         }

         .main-container table {
            max-width: 100%;
         }

         .main-container pre {
            max-width: 100%;
            overflow-x: auto;
         }

         .main-container,
         .main-container > * {
            min-width: 0;
            max-width: 100%;
         }

         .main-container .section-title,
         .main-container .section-title h1,
         .main-container .section-title h2,
         .main-container .section-title h3,
         .main-container .section-title p {
            max-width: 100%;
            overflow-wrap: anywhere;
            white-space: normal;
         }

         .header {
            z-index: 1030;
         }

         .header .navbar,
         .header .navbar > .container {
            min-height: 80px;
         }

         li.nav-item.btnLogin a {
            background: #1a3cff;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            line-height: 1.2 !important;
            padding: 0 18px !important;
            margin: 0 0 0 10px;
            border-radius: 3px;
         }

         li.nav-item.btnLogin a:hover,
         li.nav-item.btnLogin a:focus {
            background: #3152ff;
            color: #fff !important;
         }

         .nav-cart-link { position: relative; white-space: nowrap; }
         .nav-cart-link i { color: #00e5ff; margin-right: 4px; }
         .cart-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 19px;
            height: 19px;
            margin-left: 4px;
            padding: 0 5px;
            border-radius: 10px;
            background: #ff3e70;
            color: #fff;
            font-size: 11px;
            font-weight: 800;
            line-height: 19px;
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

         /* Imagen de horarios: reemplaza la lista, se ve completa sin recortarse */
         .footer-area-custom .footer-schedule-img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: contain;
            border-radius: 8px;
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

         /* ── BOTÓN FLOTANTE DE WHATSAPP ── */
         .whatsapp-float {
            position: fixed;
            bottom: 25px;
            right: 25px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25d366, #128c7e);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            z-index: 9999;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
         }

         .whatsapp-float:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.5);
         }

         .whatsapp-float i {
            color: #fff;
            font-size: 30px;
         }

         .whatsapp-float .pulse-ring {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #25d366;
            animation: whatsapp-pulse 2s infinite;
         }

         @keyframes whatsapp-pulse {
            0%   { transform: scale(1);   opacity: 0.6; }
            100% { transform: scale(1.6); opacity: 0; }
         }

         @media (max-width: 768px) {
            .whatsapp-float {
               width: 52px;
               height: 52px;
               bottom: 18px;
               right: 18px;
            }
            .whatsapp-float .pulse-ring {
               width: 52px;
               height: 52px;
            }
            .whatsapp-float i {
               font-size: 26px;
            }
         }

         .footer-gallery-section {
            background: #111;
            width: 100%;
            max-width: 100%;
            overflow: hidden;
         }

         .footer-gallery-section > .container {
            width: 100%;
            max-width: 1320px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 15px;
            padding-right: 15px;
            overflow: hidden;
         }

         .footer-gallery {
            width: 100%;
            max-width: 100%;
            overflow: hidden;
         }

         .footer-gallery .item a,
         .footer-gallery .item img {
            display: block;
            width: 100%;
         }

         .footer-gallery .item img {
            height: 220px;
            object-fit: cover;
         }

         @media (min-width: 992px) {
            body {
               padding-top: 80px;
            }
         }

         @media (max-width: 991px) {
            html,
            body,
            .main-container {
               width: 100% !important;
               max-width: 100vw !important;
               overflow-x: hidden !important;
            }

            html {
               scroll-padding-top: 0;
            }

            body {
               padding-top: 64px;
            }

            .header.fixed-top {
               position: fixed !important;
               top: 0;
               left: 0;
               right: 0;
            }

            .header .navbar,
            .header .navbar > .container {
               height: 64px;
               min-height: 64px;
            }

            .header .navbar-header {
               display: flex;
               align-items: center;
               justify-content: space-between;
               width: 100%;
               height: 64px;
               padding: 8px 16px !important;
            }

            .header .navbar .navbar-brand {
               width: auto !important;
               padding: 0;
            }

            .navbar-brand img {
               width: auto !important;
               max-width: 88px !important;
               max-height: 48px;
            }

            .header .navbar .navbar-header .navbar-toggler {
               float: none;
               margin: 0;
            }

            .header .navbar-collapse {
               max-height: calc(100vh - 64px);
               overflow-y: auto;
            }

            .header .navbar .navbar-nav .nav-item .nav-link {
               line-height: 44px !important;
            }

            .main-container .section-title h3 {
               font-size: clamp(1.2rem, 6vw, 1.8rem) !important;
               line-height: 1.2 !important;
            }

            .main-container .container,
            .main-container .section-title,
            .main-container .section-title h1,
            .main-container .section-title h2,
            .main-container .section-title h3,
            .main-container .section-title p {
               width: 100%;
               max-width: 100% !important;
               min-width: 0;
               box-sizing: border-box;
            }

            .main-container .section-title h1,
            .main-container .section-title h2,
            .main-container .section-title h3,
            .main-container .section-title p {
               display: block !important;
               width: calc(100vw - 30px) !important;
               max-width: calc(100vw - 30px) !important;
               padding-left: 8px;
               padding-right: 8px;
               white-space: normal !important;
               overflow-wrap: anywhere !important;
               word-break: normal !important;
            }

            li.nav-item.btnLogin a {
               margin: 8px 0 !important;
               display: inline-block;
               min-height: 40px;
               line-height: 40px !important;
            }
            .footer-area-custom .col-md-3,
            .footer-area-custom .col-md-4,
            .footer-area-custom .col-md-2 {
               text-align: center;
               margin-bottom: 30px;
            }
            .footer-area-custom .footer-contact-item {
               justify-content: center;
            }
            .footer-area-custom .social-links {
               justify-content: center;
            }

            .footer-area-custom .container {
               width: 100%;
               max-width: 100%;
               padding-left: 20px;
               padding-right: 20px;
            }

            .footer-area-custom .footer-desc,
            .footer-area-custom .footer-contact-item span {
               overflow-wrap: normal;
               white-space: normal !important;
               word-break: normal !important;
               max-width: 320px;
               margin-left: auto;
               margin-right: auto;
            }

            .footer-gallery .item img {
               height: 160px;
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
               <div class="container">
                  <div class="footer-gallery owl-carousel">
                     <div class="item active">
                        <a href="{{url('template/website/assets/images/instagram/big1.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/1.jpg')}}" alt="Instagram Fitness Club">
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big2.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/2.jpg')}}" alt="Instagram Fitness Club">
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big3.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/3.jpg')}}" alt="Instagram Fitness Club">
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big4.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/4.jpg')}}" alt="Instagram Fitness Club">
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big5.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/5.jpg')}}" alt="Instagram Fitness Club">
                        </a>
                     </div>
                     <div class="item">
                        <a href="{{url('template/website/assets/images/instagram/big6.jpg')}}">
                           <img src="{{url('template/website/assets/images/instagram/6.jpg')}}" alt="Instagram Fitness Club">
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
                           <a href="https://www.instagram.com/fitnessclub_tunja?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" title="Instagram"><i class="fa fa-instagram"></i></a>
                           <a href="https://www.facebook.com/bikekafitnessclub?locale=es_LA" title="Facebook"><i class="fa fa-facebook"></i></a>
                           <a href="https://www.tiktok.com/@fitnessclubtunja1?is_from_webapp=1&sender_device=pc" title="Tik tok">
                              <svg viewBox="0 0 24 24" width="1em" height="1em" fill="currentColor" style="vertical-align:middle;">
                                 <path d="M16.6 5.82s.51.5 0 0A4.278 4.278 0 0 1 15.54 3h-3.09v12.4a2.592 2.592 0 0 1-2.59 2.5c-1.42 0-2.6-1.16-2.6-2.6 0-1.72 1.66-3.01 3.37-2.48V9.66c-3.45-.46-6.47 2.22-6.47 5.64 0 3.33 2.76 5.7 5.69 5.7 3.14 0 5.69-2.55 5.69-5.7V9.01a7.35 7.35 0 0 0 4.3 1.38V7.3s-1.88.09-3.24-1.48z"/>
                              </svg>
                           </a>
                        </div>
                     </div>

                     <!-- Columna 2: Links rápidos -->
                     <div class="col-md-2 col-sm-6 mb-4">
                        <h5 class="footer-section-title">Navegación</h5>
                        <div class="footer-links">
                           <ul>
                              <li><a href="{{ url('/') }}"><i class="fa fa-angle-right"></i> Inicio</a></li>
                              <!--<li><a href="{{ url('tienda') }}"><i class="fa fa-angle-right"></i> Tienda</a></li>
                              <li><a href="{{ route('website.membresias.index') }}"><i class="fa fa-angle-right"></i> Membresías</a></li>-->
                              <li><a href="{{ url('/') }}#contacto"><i class="fa fa-angle-right"></i> Contacto</a></li>
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

                     <!-- Columna 4: Horarios (reemplazado por imagen) -->
                     <div class="col-md-4 col-sm-12 mb-4">
                        <h5 class="footer-section-title">Horarios</h5>
                        <img src="{{url('img/horarios.png')}}" alt="Horarios Fitness Club Tunja" class="footer-schedule-img">
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

      <!-- ══ BOTÓN FLOTANTE DE WHATSAPP ══ -->
      <a href="https://wa.me/573214978403" target="_blank" class="whatsapp-float" title="Escríbenos por WhatsApp">
         <span class="pulse-ring"></span>
         <i class="fa fa-whatsapp"></i>
      </a>

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
