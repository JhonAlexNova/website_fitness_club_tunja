@extends("website.layouts.app")
@section("title", "Fitness Club Tunja | Gimnasio y entrenamiento en Boyacá")
@section("seo_description", "Entrena en Fitness Club Tunja: gimnasio, entrenamiento profesional, planes personalizados y membresías en Tunja, Boyacá.")
@section("seo_canonical", url('/'))
@section("content")
<style>
   #rev_slider_1_wrapper h1,
   #rev_slider_1_wrapper h2{
       color:#fff !important
   }

   /* Fix: la imagen de fondo del slider tenía z-index más alto que el texto,
      lo que hacía que el texto quedara tapado (visible en móvil) */
   #rev_slider_1_wrapper .tp-caption {
       z-index: 100 !important;
   }
   #rev_slider_1_wrapper .tp-bgimg,
   #rev_slider_1_wrapper .rev-slidebg {
       z-index: 1 !important;
   }

   /* ===== TEMA OSCURO GENERAL ===== */
   body {
       background: radial-gradient(circle at top, #0f0f1f, #050505) !important;
   }

   .home-mobile-hero {
       display: flex;
       width: 100%;
       min-height: 520px;
       align-items: center;
       justify-content: center;
       position: relative;
       padding: 90px 24px 70px;
       text-align: center;
       background: linear-gradient(rgba(5,5,15,.60), rgba(5,5,15,.88)), url('{{url('template/website/assets/images/slider-show/s-7.jpg')}}') center / cover;
   }

   .home-mobile-hero .hero-content {
       width: 100%;
       max-width: 780px;
       position: relative;
       z-index: 1;
   }

   .home-mobile-hero .eyebrow {
       color: #00f0ff;
       font-size: .9rem;
       font-weight: 800;
       letter-spacing: 3px;
       text-transform: uppercase;
       margin-bottom: 14px;
   }

   .home-mobile-hero h1 {
       color: #fff;
       font-size: clamp(2.4rem, 5vw, 4.5rem);
       line-height: 1.05;
       margin-bottom: 18px;
       white-space: normal;
   }

   .home-mobile-hero p {
       color: #e7e7f4;
       font-size: 1.1rem;
       line-height: 1.6;
       max-width: 650px;
       margin: 0 auto 28px;
   }

   .home-mobile-hero .hero-cta {
       display: inline-flex;
       align-items: center;
       min-height: 48px;
       padding: 0 28px;
       border-radius: 24px;
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       color: #fff;
       font-weight: 800;
       text-transform: uppercase;
       letter-spacing: .8px;
   }

   .slider-area1 {
       display: none !important;
   }

   /* ===== FEATURES (Culturismo/Fitness/Levantamiento) ===== */
   .features-area {
       background: transparent;
       padding-top: 20px;
   }
   .features-area .features-body {
       background: transparent !important;
       box-shadow: none !important;
       display: flex;
       flex-wrap: nowrap;
       gap: 20px;
       transform: none !important;
   }
   .features-area .features-body .features-box {
       display: flex;
       flex-direction: column;
       flex: 0 0 calc(33.333% - 14px);
       max-width: calc(33.333% - 14px);
       min-height: 420px;
       background: rgba(20,20,40,0.8) !important;
       border-radius: 20px;
       overflow: hidden;
       border-left: 4px solid #00f0ff;
       backdrop-filter: blur(15px);
       box-shadow: 0 10px 30px rgba(0,0,0,0.4);
       transition: 0.3s;
       min-width: 0;
   }
   .features-area .features-body .features-box:nth-child(even) {
       border-left-color: #8a2be2;
   }
   .features-area .features-body .features-box:hover {
       transform: translateY(-8px);
       box-shadow: 0 20px 40px rgba(0,0,0,0.5);
   }
   .features-area .features-body .features-box .features-elements {
       display: flex;
       flex-direction: column;
       justify-content: center;
       align-items: center;
       flex: 1;
       text-align: center;
       padding: 30px 25px;
   }
   .features-area .features-body .features-box .features-elements a i:before {
       font-size: 55px;
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       background-clip: text;
   }
   .features-area .features-body .features-box .features-elements h4 {
       color: #fff !important;
       font-size: 1.3rem;
       font-weight: 800;
       text-transform: uppercase;
       margin: 15px 0 12px;
   }
   .features-area .features-body .features-box .features-elements p {
       color: #aaa !important;
       max-width: 300px;
       margin: 0 auto;
       font-size: 0.8rem;
       overflow-wrap: anywhere;
   }
   .features-area .features-body .features-box .features-box-img {
       flex: 1;
       display: flex;
       min-height: 0;
   }
   .features-area .features-body .features-box .features-box-img a {
       width: 100%;
       height: 100%;
       display: block;
   }
   .features-area .features-body .features-box .features-box-img img {
       width: 100%;
       height: 100%;
       object-fit: cover;
       display: block;
   }

   /* ===== CALL TO ACTION 1 ===== */
   .call-to-action1 {
       background: transparent;
       padding: 60px 0;
   }
   .call-to-action1 .cta-img img {
       border-radius: 20px;
       border: 1px solid rgba(138,43,226,0.3);
   }
   .call-to-action1 .cta-box h4.sub-title {
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       background-clip: text;
       font-weight: 800;
       text-transform: uppercase;
   }
   .call-to-action1 .cta-box h5.title {
       color: #fff !important;
       font-weight: 900;
   }
   .call-to-action1 .cta-box p {
       color: #aaa !important;
   }
   .call-to-action1 .bttn .btn {
       background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
       color: #fff !important;
       border-radius: 25px !important;
       padding: 14px 40px !important;
       font-weight: 700;
       text-transform: uppercase;
       letter-spacing: 1px;
       border: none !important;
       transition: 0.3s;
   }
   .call-to-action1 .bttn .btn:hover {
       transform: translateY(-3px);
       opacity: 0.9;
   }

   /* ===== SECTION TITLES GENERALES ===== */
   .section-title h3 {
       color: #fff !important;
       font-weight: 900;
       text-transform: uppercase;
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       background-clip: text;
   }
   .section-title p {
       color: #aaa !important;
   }
   .title-white .section-title h3 {
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       background-clip: text;
   }

   /* ===== CLASES DE ENTRENAMIENTO (portfolio-area) ===== */
   .portfolio-area .port-carousel {
       display: flex;
       gap: 15px;
       flex-wrap: wrap;
       width: 100%;
       max-width: 1320px;
       margin-left: auto;
       margin-right: auto;
       padding-left: 15px;
       padding-right: 15px;
       box-sizing: border-box;
       overflow: hidden;
   }
   .portfolio-area .port-box {
       flex: 1 1 calc(25% - 12px);
       min-width: 220px;
   }
   .portfolio-area .port-box .port-img {
       height: 320px;
       overflow: hidden;
       border-radius: 12px;
   }
   .portfolio-area .port-box .port-img a {
       display: block;
       width: 100%;
       height: 100%;
   }
   .portfolio-area .port-box .port-img img {
       width: 100%;
       height: 100%;
       object-fit: cover;
       display: block;
   }

   /* ===== CLASS SCHEDULE ===== */
   .schedule-area.bg2 {
       background: radial-gradient(circle at bottom, #0f0f1f, #050505) !important;
   }
   .schedule-area .schdl-tab-area li a {
       background: rgba(20,20,40,0.8) !important;
       color: #fff !important;
       border-radius: 8px;
       margin-bottom: 5px;
       border-left: 3px solid #00f0ff;
   }
   .schedule-area .schdl-tab-area li a:hover,
   .schedule-area .schdl-tab-area li a.active {
       background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
       border-left-color: transparent;
   }
   .schedule-area .tab-content .tab-pane .schdl-box {
       background: rgba(20,20,40,0.8) !important;
       border: 1px solid rgba(138,43,226,0.3) !important;
       border-radius: 12px;
       backdrop-filter: blur(10px);
   }
   .schedule-area .tab-content .tab-pane .schdl-box h5 {
       color: #fff !important;
   }
   .schedule-area .tab-content .tab-pane .schdl-box p {
       color: #aaa !important;
   }
   .schedule-area .tab-content .tab-pane .schdl-box:hover {
       background: linear-gradient(90deg, #8a2be2, #00f0ff) !important;
   }
   .schedule-area .dwnload a {
       color: #fff !important;
   }
   .schedule-area .dwnload a span i {
       background: linear-gradient(90deg, #8a2be2, #00f0ff);
       -webkit-background-clip: text;
       -webkit-text-fill-color: transparent;
       background-clip: text;
   }

   /* ===== CONTACTO (por si el style local no llegó a cargar) ===== */
   #contacto {
       background: radial-gradient(circle at bottom, #0f0f1f, #050505) !important;
       scroll-margin-top: 96px;
       position: relative;
       z-index: 0;
   }

   #contacto .contact-card {
       height: 100%;
       min-height: 190px;
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       background: rgba(20,20,40,0.8);
       border-radius: 20px;
       padding: 32px 20px;
       text-align: center;
       backdrop-filter: blur(15px);
       transition: transform 0.3s ease, box-shadow 0.3s ease;
   }

   #contacto .contact-card:hover {
       transform: translateY(-6px);
       box-shadow: 0 16px 32px rgba(0,0,0,0.35);
   }

   #contacto .contact-card a {
       color: #aaa;
       overflow-wrap: anywhere;
   }

   #contacto .contact-card a:hover {
       color: #fff;
   }

   #contacto .contact-whatsapp {
       display: inline-flex;
       align-items: center;
       justify-content: center;
       gap: 8px;
       max-width: 100%;
       padding: 15px 32px;
       border-radius: 30px;
       background: linear-gradient(90deg,#25d366,#128c7e);
       color: #fff;
       font-weight: 700;
       font-size: 1rem;
       text-transform: uppercase;
       letter-spacing: 1px;
       text-decoration: none;
       transition: transform 0.3s ease, box-shadow 0.3s ease;
   }

   #contacto .contact-whatsapp:hover {
       color: #fff;
       transform: translateY(-3px);
       box-shadow: 0 10px 24px rgba(37,211,102,0.25);
   }

   /* Salvaguarda: nunca permitir scroll horizontal en toda la página */
   html, body {
       overflow-x: hidden !important;
       max-width: 100%;
   }

   /* =========================================================
      ===================  RESPONSIVE MOBILE  ==================
      ========================================================= */
   @media (max-width: 768px) {
       .slider-area1 {
           display: none !important;
       }

       .home-mobile-hero {
           width: 100vw;
           margin-left: calc(50% - 50vw);
           min-height: 420px;
           display: flex;
           align-items: center;
           justify-content: center;
           position: relative;
           padding: 54px 22px 42px;
           text-align: center;
           background: linear-gradient(rgba(5,5,15,.68), rgba(5,5,15,.86)), url('{{url('template/website/assets/images/slider-show/s-7.jpg')}}') center / cover;
       }

       .home-mobile-hero .hero-content {
           position: relative;
           z-index: 1;
           max-width: calc(100vw - 30px);
           width: 100%;
           min-width: 0;
       }

       .home-mobile-hero .eyebrow {
           color: #00f0ff;
           font-size: .78rem;
           font-weight: 800;
           letter-spacing: 2px;
           text-transform: uppercase;
           margin-bottom: 12px;
       }

       .home-mobile-hero h1 {
           color: #fff;
           font-size: clamp(1.55rem, 6vw, 1.75rem);
           line-height: 1.05;
           margin-bottom: 16px;
           width: 300px;
           max-width: 100%;
           margin-left: auto;
           margin-right: auto;
           white-space: normal !important;
           overflow-wrap: anywhere;
           word-break: normal;
       }

       .home-mobile-hero p {
           color: #e7e7f4;
           font-size: .78rem;
           line-height: 1.6;
           margin-bottom: 24px;
           max-width: 310px;
           width: 100%;
           white-space: normal !important;
           overflow-wrap: normal;
           word-break: normal;
       }

       .home-mobile-hero .hero-cta {
           display: inline-flex;
           align-items: center;
           min-height: 44px;
           padding: 0 22px;
           border-radius: 24px;
           background: linear-gradient(90deg, #8a2be2, #00f0ff);
           color: #fff;
           font-weight: 800;
           text-transform: uppercase;
           letter-spacing: .7px;
       }

       /* Textos del slider: el style.css original fuerza 65px/28px con !important
          en TODOS los tamaños de pantalla, bloqueando el responsive del plugin.
          Los reducimos aquí para que quepan en móvil sin encimarse. */
       #rev_slider_1_wrapper .tp-caption.slide-text-one h1,
       #rev_slider_1_wrapper .tp-caption.slide-text-one h1 span {
           font-size: 22px !important;
           line-height: 26px !important;
       }
       #rev_slider_1_wrapper .tp-caption.slide-text-two h1,
       #rev_slider_1_wrapper .tp-caption.slide-text-two h2 {
           font-size: 13px !important;
           line-height: 18px !important;
       }
       #rev_slider_1_wrapper .tp-caption.rev-btn {
           padding: 8px 14px !important;
           font-size: 12px !important;
       }
       /* El HTML trae data-whitespace="nowrap" -> impide el salto de línea
          y corta el texto en el borde de la pantalla. Lo forzamos a wrap. */
       #rev_slider_1_wrapper .tp-caption.slide-text-one,
       #rev_slider_1_wrapper .tp-caption.slide-text-two {
           white-space: normal !important;
           text-align: center !important;
       }
       /* Centrar y dar ancho real a cada capa por id (más confiable que por clase) */
       #rev_slider_1_wrapper .tp-caption[id*="layer-1"],
       #rev_slider_1_wrapper .tp-caption[id*="layer-2"],
       #rev_slider_1_wrapper .tp-caption[id*="layer-4"] {
           left: 50% !important;
           transform: translateX(-50%) !important;
           width: 94% !important;
           max-width: 94% !important;
           text-align: center !important;
       }
       #rev_slider_1_wrapper .tp-caption[id*="layer-1"] {
           top: 70px !important;
       }
       #rev_slider_1_wrapper .tp-caption[id*="layer-2"] {
           top: 110px !important;
       }
       #rev_slider_1_wrapper .tp-caption[id*="layer-4"] {
           top: 350px !important;
       }

       /* Títulos de sección (Clases de Entrenamiento, etc.) se desbordaban
          porque style.css fuerza 40px fijo en todas las pantallas */
       .section-title h3 {
           font-size: 1.6rem !important;
           line-height: 1.3 !important;
           letter-spacing: 0.5px;
           word-break: break-word;
       }
       .section-title p {
           font-size: 0.9rem !important;
           margin: 15px 0 25px !important;
       }
       #contacto h2 {
           font-size: 1.7rem !important;
       }
       /* Flechas de navegación: forzarlas a los extremos reales de la pantalla */
       #rev_slider_1_wrapper .tparrows {
           position: absolute !important;
           top: 50% !important;
           transform: translateY(-50%) !important;
       }
       #rev_slider_1_wrapper .tp-leftarrow {
           left: 8px !important;
           right: auto !important;
       }
       #rev_slider_1_wrapper .tp-rightarrow {
           right: 8px !important;
           left: auto !important;
       }
       /* Slider */
       #rev_slider_1_wrapper,
       #rev_slider_1_wrapper .rev_slider,
       #rev_slider_1_wrapper .forcefullwidth_wrapper_tp_banner,
       #rev_slider_1_wrapper ul,
       #rev_slider_1_wrapper > ul > li {
           height: 460px !important;
           min-height: 460px !important;
           max-height: 460px !important;
       }
       .slider-area1 {
           height: 460px;
       }

       /* Features */
       .features-area .features-body {
           flex-wrap: wrap;
       }
       .features-area .features-body .features-box {
           flex: 0 0 100%;
           max-width: 100%;
           width: 100%;
           min-width: 0;
           min-height: 380px;
       }

       /* Call to action */
       .call-to-action1 .cta-img { margin-bottom: 20px; }
       .call-to-action1 .cta-box h5.title { font-size: 1.5rem; }
       .call-to-action1 .cta-box h4.sub-title { font-size: 1.2rem; }
       .call-to-action1 .bttn { text-align: center; }

       /* Portfolio / Clases de entrenamiento */
       .portfolio-area .port-carousel {
           flex-direction: column;
       }
       .portfolio-area .port-box {
           flex: 1 1 100%;
           min-width: 100%;
       }
       .portfolio-area .port-box .port-img {
           height: 240px;
       }
       .portfolio-area .port-box .port-dtl {
           opacity: 1 !important;
           position: relative !important;
           bottom: 0 !important;
           padding: 15px 10px;
       }

       /* Schedule mobile: mismo layout (día a un lado, clases al otro), clases en columnas de a dos */
       .schedule-area .schdl-tab-area {
           width: 28% !important;
       }
       .schedule-area .schdl-tab-area li a {
           font-size: 12px;
           padding: 9px 6px !important;
       }
       .schedule-area .tab-content {
           width: 72% !important;
       }
       .schedule-area .tab-content .tab-pane.active {
           display: flex;
           flex-wrap: wrap !important;
           justify-content: space-between;
       }
       .schedule-area .tab-content .tab-pane .schdl-box {
           width: calc(50% - 8px);
           min-width: 0;
           height: auto;
           min-height: 90px;
           margin: 0 0 12px !important;
           flex-shrink: 0;
           padding: 12px 8px;
       }
       .schedule-area .tab-content .tab-pane .schdl-box h5 {
           font-size: 13px !important;
       }
       .schedule-area .tab-content .tab-pane .schdl-box p {
           font-size: 11px !important;
       }

       /* Contacto */
       #contacto .col-md-4 { margin-bottom: 10px; }
   }

   @media (max-width: 480px) {
       #rev_slider_1_wrapper,
       #rev_slider_1_wrapper .rev_slider,
       #rev_slider_1_wrapper .forcefullwidth_wrapper_tp_banner,
       #rev_slider_1_wrapper ul,
       #rev_slider_1_wrapper > ul > li {
           height: 400px !important;
           min-height: 400px !important;
           max-height: 400px !important;
       }
       .slider-area1 { height: 400px; }
       .schedule-area .schdl-tab-area li a { font-size: 11px; padding: 8px 4px !important; }
   }
</style>
<section class="home-mobile-hero" aria-label="Fitness Club Tunja">
   <div class="hero-content">
      <div class="eyebrow">Fitness Club Tunja</div>
      <h1>Entrena con pasión</h1>
      <p>Transforma tu cuerpo y mente con entrenamiento profesional y planes para todos los niveles.</p>
      <a class="hero-cta" href="#contacto">Conócenos</a>
   </div>
</section>
<div class="slider-area1">
   <!--  -->
   <div id="rev_slider_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="photography1" style="background-color:transparent;padding:0px;">
      <div id="rev_slider_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.0.7">
         <ul>
            <li data-index="rs-1" data-transition="slideoververtical">
               <img src="{{url('template/website/assets/images/slider-show/s-7.jpg')}}" alt="Entrenamiento de fuerza en Fitness Club Tunja" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina="">
               <div class="tp-caption slide-text-one tp-resizeme" id="slide-1-layer-1" data-x="['left','center','center','center']" data-hoffset="['65','50','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-100','-145','-60','-100']" data-fontsize="['inherit','20','20','17']" data-lineheight="['60','30','30','26']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-100%];opacity:0;s:2000;e:Power4.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h1>Entrena <span>con pasión</span></h1>
               </div>
               <div class="tp-caption slide-text-two tp-resizeme" id="slide-1-layer-2" data-x="['left','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','-80','30','0']" data-fontsize="['60','60','60','30']" data-lineheight="['60','60','60','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-100%];opacity:0;s:2300;e:Power4.easeInOut;" data-start="750" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h2>Transforma tu cuerpo y mente en Fitness Club</h2>
               </div>
               <div class="tp-caption rev-btn white-btn" id="slide-1-layer-4" data-x="['left','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','bottom','bottom']" data-voffset="['100','160','320','200']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="1250" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap; font-size: 18px; line-height: 15px; color: rgba(255, 255, 255, 1.00);font-family:'Roboto Condensed', sans-serif;text-transform: uppercase;">Únete ahora</div>
            </li>
            <li data-index="rs-2" data-transition="slideoververtical">
               <img src="{{url('template/website/assets/images/slider-show/s-2.jpg')}}" alt="Entrenamiento fitness en Fitness Club Tunja" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina="">
               <div class="tp-caption slide-text-one tp-resizeme" id="slide-2-layer-1" data-x="['right','center','center','center']" data-hoffset="['65','50','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-100','-145','-60','-100']" data-fontsize="['inherit','20','20','17']" data-lineheight="['60','30','30','26']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="500" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h2>Resultados <span>garantizados</span></h2>
               </div>
               <div class="tp-caption slide-text-two tp-resizeme" id="slide-2-layer-2" data-x="['right','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','-80','30','0']" data-fontsize="['60','60','60','30']" data-lineheight="['60','60','60','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="750" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h2>Planes de entrenamiento para todos los niveles</h2>
               </div>
               <div class="tp-caption rev-btn white-btn" id="slide-2-layer-4" data-x="['right','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','bottom','bottom']" data-voffset="['100','160','320','200']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="1250" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap; font-size: 18px; line-height: 15px; color: rgba(255, 255, 255, 1.00);font-family:'Roboto Condensed', sans-serif;text-transform: uppercase;">Conócenos</div>
            </li>
         </ul>
      </div>
   </div>
   <!--  -->
</div>
<div class="features-area pb30">
   <div class="container">
      <!--  -->
      <div class="row">
   <div class="col-lg-12">
      <div class="features-body">
         <div class="features-box text-center">
            <div class="features-elements">
               <a href="#"><i class="fa fa flaticon-exercise"></i></a>
               <h4 class="mb20">Culturismo</h4>
               <p class="mb20">Desarrolla tu fuerza y masa muscular con entrenamientos intensivos y asesoramiento personalizado.</p>
            </div>
            <div class="features-box-img">
               <a class="primary-overlay" href="#"><img src="{{url('template/website/assets/images/feature/1.jpg')}}" alt="Culturismo"></a>
            </div>
         </div>
         <div class="features-box text-center">
            <div class="features-elements">
               <a href="#"><i class="fa fa flaticon-weightlifting"></i></a>
               <h4 class="mb20">Fitness</h4>
               <p class="mb20">Mejora tu resistencia, flexibilidad y bienestar con nuestras rutinas de fitness diseñadas para todos los niveles.</p>
            </div>
            <div class="features-box-img">
               <a class="primary-overlay" href="#"><img src="{{url('template/website/assets/images/feature/2.jpg')}}" alt="Fitness"></a>
            </div>
         </div>
         <div class="features-box text-center">
            <div class="features-elements">
               <a href="#"><i class="fa fa flaticon-dumbbell"></i></a>
               <h4 class="mb20">Levantamiento de pesas</h4>
               <p class="mb20">Potencia tu fuerza con ejercicios de levantamiento de pesas y entrenamiento especializado para alcanzar tu máximo rendimiento.</p>
            </div>
            <div class="features-box-img">
               <a class="primary-overlay" href="#"><img src="{{url('template/website/assets/images/feature/3.jpg')}}" alt="Levantamiento de pesas"></a>
            </div>
         </div>
      </div>
   </div>
</div>

      <!--  -->
   </div>
</div>
<div class="call-to-action1">
   <div class="container">
   <div class="row">
   <div class="col-lg-6">
      <div class="cta-img">
         <img src="{{url('template/website/assets/images/call-to-action/5.png')}}" alt="Chica entrenando">
      </div>
   </div>
   <div class="col-lg-6">
      <div class="cta-box">
         <h4 class="sub-title mb30">¡Únete hoy y obtén lo mejor!</h4>
         <h5 class="title mb30">La mejor oferta de membresía del año</h5>
         <p class="mb30">
            Aprovecha esta oportunidad única para acceder a entrenamientos exclusivos, asesoramiento personalizado y un ambiente diseñado para alcanzar tus metas. 
            No dejes pasar la oportunidad de transformar tu estilo de vida.
         </p>
         <div class="bttn">
            <button type="submit" class="btn active btn-primary">Regístrate</button>
         </div>
      </div>
   </div>
</div>

   </div>
</div>
<!--  -->
<div class="portfolio-area title-white bg1 parallax overlay pad90">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20">
                  <div style="width:60px;height:3px;background:#1a3cff;margin:0 auto;border-radius:3px;"></div>
               </div>
               <h3>Clases de Entrenamiento</h3>
               <p>Descubre nuestras clases diseñadas para mejorar tu salud y rendimiento físico.</p>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
   <div class="port-carousel port-zoom">
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/Up_Force.png')}}">
               <img src="{{url('template/website/assets/images/class-schedule/Up_Force.png')}}" alt="clase de entrenamiento">
            </a>
         </div>
         <div class="port-dtl">
            <h5>Entrenamiento de Fuerza</h5>
            <p>Mejora tu resistencia y tonifica tu cuerpo con nuestros entrenamientos de fuerza guiados por expertos.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/Indoor_Cycling.png')}}">
               <img src="{{url('template/website/assets/images/class-schedule/Indoor_Cycling.png')}}" alt="clase de entrenamiento">
            </a>
         </div>
         <div class="port-dtl">
            <h5>Indoor Cycling</h5>
            <p>Quema calorías rápidamente con entrenamientos de alta intensidad diseñados para todos los niveles.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big3.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/Zumba.png')}}" alt="clase de entrenamiento">
            </a>
         </div>
         <div class="port-dtl">
            <h5>Zumba</h5>
            <p>Una clase dinámica que combina baile y ejercicio para mejorar tu condición física, quemar calorías y divertirte al ritmo de la música.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big4.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/Cardio_Box.png')}}" alt="clase de entrenamiento">
            </a>
         </div>
         <div class="port-dtl">
            <h5>Cardio Box</h5>
            <p>Una clase de alta intensidad que combina movimientos de boxeo con ejercicios cardiovasculares para mejorar la resistencia, la coordinación y la condición física.</p>
         </div>
      </div>
      <!--<div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big1.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/1.jpg')}}" alt="clase de entrenamiento">
               <i class="ovrlay fa fa-search"></i>
            </a>
         </div>
         <div class="port-dtl">
            <h5>Entrenamiento Personalizado</h5>
            <p>Consigue resultados con un plan de entrenamiento adaptado a tus objetivos personales.</p>
         </div>
      </div>-->
   </div>
   </div>
</div>

<!--  -->
<div class="schedule-area bg2 parallax pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20">
                  <div style="width:60px;height:3px;background:#1a3cff;margin:0 auto;border-radius:3px;"></div>
               </div>
               <h3>Horario de clases</h3>
               <p>Se mas fuerte que tus excusas</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <ul id="tabsJustified" class="nav nav-tabs schdl-tab-area">
               <li class="nav-item full-width"><a href="" data-target="#level1" data-toggle="tab" class="nav-link small text-uppercase active">monday </a></li>
               <li class="nav-item full-width"><a href="" data-target="#level2" data-toggle="tab" class="nav-link small text-uppercase ">tuesday</a></li>
               <li class="nav-item full-width"><a href="" data-target="#level3" data-toggle="tab" class="nav-link small text-uppercase ">wednesday</a></li>
               <li class="nav-item full-width"><a href="" data-target="#level4" data-toggle="tab" class="nav-link small text-uppercase ">thursday</a></li>
               <li class="nav-item full-width"><a href="" data-target="#level5" data-toggle="tab" class="nav-link small text-uppercase ">friday</a></li>
               <li class="nav-item full-width"><a href="" data-target="#level6" data-toggle="tab" class="nav-link small text-uppercase ">saturday</a></li>
            </ul>
            <div id="tabsJustifiedContent" class="tab-content">

               <!--LUNES-->

               <div id="level1" class="tab-pane fade active show">
                  <div class="schdl-box">
                     <h5>Full Body</h5>
                     <p class="mb-0">6:00 am – 7:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">7:00 am – 8:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">8:00 am – 9:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09:00 am – 10:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">10:00 am – 11:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">04:00 pm – 05:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Full Body Kids</h5>
                     <p class="mb-0">05:00 pm – 06:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Funtional beats</h5>
                     <p class="mb-0">06:30  – 07:30 </p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07:00 pm – 08:00pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">08:00 pm – 09:00 pm</p>
                  </div>
               </div>

               <!--MARTES-->

               <div id="level2" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">5:00 am – 6:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">6:00 am – 7:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">7:00 am – 8:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">8:00 am – 9:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">9:00 am – 11.00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">4:00 pm – 6:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">6:00 pm – 7:00 pm</p>
                  </div>
                   <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">7:00 pm – 8:00 pm</p>
                  </div>
                   <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">8:00 pm – 9:00 pm</p>
                  </div>
               </div>

               <!--MIERCOLES-->

               <div id="level3" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>Power Sport</h5>
                     <p class="mb-0">5:00 am – 6:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Power Sport</h5>
                     <p class="mb-0">6:00 am – 7:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Power Sport</h5>
                     <p class="mb-0">7:00 am – 8:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Funtional Senior</h5>
                     <p class="mb-0">8:00 am – 9:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">9:00 am – 11:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">4:00 pm – 5:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Full Body Kids</h5>
                     <p class="mb-0">5:00 pm – 6:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">6:00 pm – 6:30 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Zumba</h5>
                     <p class="mb-0">6:30 pm – 7:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Power Sport</h5>
                     <p class="mb-0">7:00 pm – 8:00 pm</p>
                  </div>
               </div>

               <!--JUEVES-->

               <div id="level4" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">5:00 am – 6:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">6:00 am – 7:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">7:00 am – 8:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">8:00 am – 9:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">9:00 am – 11:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">4:00 pm – 6:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">6:00 pm – 7:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Indoor Cycling</h5>
                     <p class="mb-0">7:00 pm – 8:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Up Force</h5>
                     <p class="mb-0">8:00 pm – 9:00 pm</p>
                  </div>
               </div>

               <!--VIERNES-->

               <div id="level5" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>Cardio Box</h5>
                     <p class="mb-0">06:00 am – 07:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07:00 am – 08:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Funtional Senior</h5>
                     <p class="mb-0">08:00 am – 9:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 11:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">4:00 pm – 5:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Cardio Box Kids</h5>
                     <p class="mb-0">05:00 pm – 06:00 pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Cardio Box</h5>
                     <p class="mb-0">06:00 am – 07:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">7:00 pm – 9:00 pm</p>
                  </div>
               </div>

               <!--SÁBADO-->

               <div id="level6" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">5:00 am – 7:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Bodybuilding</h5>
                     <p class="mb-0">7:00 am – 8:00 am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">8:00 am – 12:00 am</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- CONTACTO -->
<div id="contacto" class="pad90" style="background: radial-gradient(circle at bottom, #0f0f1f, #050505);">
   <div class="container">

      <div class="row">
         <div class="col-md-12 text-center mb-5">
            <h2 style="font-size:2.5rem;font-weight:900;text-transform:uppercase;background:linear-gradient(90deg,#8a2be2,#00f0ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Contáctanos</h2>
            <p style="color:#aaa;font-size:1rem;margin-top:10px;">Estamos listos para ayudarte a transformar tu vida.</p>
         </div>
      </div>

      <div class="row justify-content-center">

         <div class="col-md-4 col-sm-6 mb-4">
            <div class="contact-card" style="border-left:4px solid #00f0ff;">
               <i class="fa fa-map-marker" style="font-size:2.5rem;background:linear-gradient(90deg,#8a2be2,#00f0ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
               <h4 style="color:#fff;font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin:15px 0 10px;">Ubicación</h4>
               <p style="color:#aaa;font-size:0.95rem;margin:0;">Tunja, Boyacá — Colombia</p>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 mb-4">
            <div class="contact-card" style="border-left:4px solid #8a2be2;">
               <i class="fa fa-phone" style="font-size:2.5rem;background:linear-gradient(90deg,#00f0ff,#8a2be2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
               <h4 style="color:#fff;font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin:15px 0 10px;">Teléfono</h4>
               <p style="color:#aaa;font-size:0.95rem;margin:0;">
                  <a href="tel:+573214978403" style="color:#aaa;text-decoration:none;">+57 321 497 8403</a>
               </p>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 mb-4">
            <div class="contact-card" style="border-left:4px solid #00f0ff;">
               <i class="fa fa-envelope" style="font-size:2.5rem;background:linear-gradient(90deg,#8a2be2,#00f0ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
               <h4 style="color:#fff;font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin:15px 0 10px;">Correo</h4>
               <p style="color:#aaa;font-size:0.95rem;margin:0;">
                  <a href="mailto:fitnessclubtunja@gmail.com" style="color:#aaa;text-decoration:none;">fitnessclubtunja@gmail.com</a>
               </p>
            </div>
         </div>

      </div>

      <!-- Botón WhatsApp -->
      <div class="row">
         <div class="col-md-12 text-center mt-3">
            <a href="https://wa.me/573214978403" target="_blank" rel="noopener noreferrer" class="contact-whatsapp">
               <i class="fa fa-whatsapp" style="font-size:1.2rem;color:#fff;"></i>
               Escríbenos por WhatsApp
            </a>
         </div>
      </div>

   </div>
</div>
@endsection
