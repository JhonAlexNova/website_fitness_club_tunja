@extends("website.layouts.app")
@section("content")
<style>
   #rev_slider_1_wrapper h1{
       color:#fff !important
   }

   /* ===== TEMA OSCURO GENERAL ===== */
   body {
       background: radial-gradient(circle at top, #0f0f1f, #050505) !important;
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
       max-width: 280px;
       margin: 0 auto;
       font-size: 0.9rem;
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

   @media (max-width: 768px) {
       .features-area .features-body {
           flex-wrap: wrap;
       }
       .features-area .features-body .features-box {
           flex: 0 0 100%;
           max-width: 100%;
       }
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
   .portfolio-area.bg1 {
       background: radial-gradient(circle at top, #0f0f1f, #050505) !important;
   }
   .portfolio-area .port-box {
       border-radius: 20px;
       overflow: hidden;
       border: 1px solid rgba(138,43,226,0.2);
   }
   .portfolio-area .port-box .port-dtl h5 {
       color: #fff !important;
       font-weight: 800;
   }
   .portfolio-area .port-box .port-dtl p {
       color: #ccc !important;
   }
   .portfolio-area .primary-overlay:before {
       background: rgba(138, 43, 226, 0.6) !important;
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
   }
</style>
<div class="slider-area1">
   <!--  -->
   <div id="rev_slider_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="photography1" style="background-color:transparent;padding:0px;">
      <div id="rev_slider_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.0.7">
         <ul>
            <li data-index="rs-1" data-transition="slideoververtical">
               <img src="{{url('template/website/assets/images/slider-show/s-1.jpg')}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina="">
               <div class="tp-caption slide-text-one tp-resizeme" id="slide-1-layer-1" data-x="['left','center','center','center']" data-hoffset="['65','50','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-100','-145','-60','-100']" data-fontsize="['inherit','20','20','17']" data-lineheight="['60','30','30','26']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-100%];opacity:0;s:2000;e:Power4.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h1>Entrena <span>con pasión</span></h1>
               </div>
               <div class="tp-caption slide-text-two tp-resizeme" id="slide-1-layer-2" data-x="['left','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','-80','30','0']" data-fontsize="['60','60','60','30']" data-lineheight="['60','60','60','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[-100%];opacity:0;s:2300;e:Power4.easeInOut;" data-start="750" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h1>Transforma tu cuerpo y mente en Fitness Club</h1>
               </div>
               <div class="tp-caption rev-btn white-btn" id="slide-1-layer-4" data-x="['left','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','bottom','bottom']" data-voffset="['100','160','320','200']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="1250" data-responsive_offset="on" data-responsive="off" style="z-index: 8; white-space: nowrap; font-size: 18px; line-height: 15px; color: rgba(255, 255, 255, 1.00);font-family:'Roboto Condensed', sans-serif;text-transform: uppercase;">Únete ahora</div>
            </li>
            <li data-index="rs-2" data-transition="slideoververtical">
               <img src="{{url('template/website/assets/images/slider-show/s-2.jpg')}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina="">
               <div class="tp-caption slide-text-one tp-resizeme" id="slide-2-layer-1" data-x="['right','center','center','center']" data-hoffset="['65','50','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-100','-145','-60','-100']" data-fontsize="['inherit','20','20','17']" data-lineheight="['60','30','30','26']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="500" data-responsive_offset="on" style="z-index: 5; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h1>Resultados <span>garantizados</span></h1>
               </div>
               <div class="tp-caption slide-text-two tp-resizeme" id="slide-2-layer-2" data-x="['right','left','center','center']" data-hoffset="['65','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','-80','30','0']" data-fontsize="['60','60','60','30']" data-lineheight="['60','60','60','40']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-start="750" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-family: 'Roboto Condensed', sans-serif">
                  <h1>Planes de entrenamiento para todos los niveles</h1>
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
         <img src="{{url('template/website/assets/images/call-to-action/cta.jpg')}}" alt="Chica entrenando">
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
   <div class="port-carousel port-zoom">
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big1.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/1.jpg')}}" alt="clase de entrenamiento">
               <i class="ovrlay fa fa-search"></i>
            </a>
         </div>
         <div class="port-dtl">
            <h5>Entrenamiento de Fuerza</h5>
            <p>Mejora tu resistencia y tonifica tu cuerpo con nuestros entrenamientos de fuerza guiados por expertos.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big2.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/2.jpg')}}" alt="clase de entrenamiento">
               <i class="ovrlay fa fa-search"></i>
            </a>
         </div>
         <div class="port-dtl">
            <h5>HIIT (Entrenamiento de Alta Intensidad)</h5>
            <p>Quema calorías rápidamente con entrenamientos de alta intensidad diseñados para todos los niveles.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big3.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/3.jpg')}}" alt="clase de entrenamiento">
               <i class="ovrlay fa fa-search"></i>
            </a>
         </div>
         <div class="port-dtl">
            <h5>Clases de Yoga</h5>
            <p>Relájate y mejora tu flexibilidad con nuestras sesiones de yoga para todos los niveles.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
         <div class="port-img">
            <a href="{{url('template/website/assets/images/class-schedule/big4.jpg')}}">
               <img src="{{url('template/website/assets/images/class-schedule/4.jpg')}}" alt="clase de entrenamiento">
               <i class="ovrlay fa fa-search"></i>
            </a>
         </div>
         <div class="port-dtl">
            <h5>CrossFit</h5>
            <p>Desafía tus límites con entrenamientos funcionales de alta intensidad en nuestras clases de CrossFit.</p>
         </div>
      </div>
      <div class="port-box primary-overlay">
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
      </div>
   </div>
</div>

<!--  -->


<!--  
<div class="pricing-area text-center pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20">
                  <img src="{{url('template/website/assets/images/logo/ttl-bar.png')}}" alt="title-img">
               </div>
               <h3>Planes de Membresía</h3>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-4">
            <div class="price-box">
               <div class="price-empty"></div>
               <div class="price-quantity">
                  <div class="qnty-box">
                     <div class="box-element">
                        <h5>$250,000 COP</h5>
                        <p>Trimestral</p>
                     </div>
                  </div>
                  <div class="price-dtl">
                     <ul>
                        <li class="first-child">3 días a la semana</li>
                        <li>Entrenador profesional</li>
                        <li>Rutinas de musculación</li>
                        <li>Ejercicios funcionales</li>
                        <li>Clases de boxeo y fitness</li>
                     </ul>
                     <div class="price-btn bttn">
                        <button type="submit" class="btn btn-primary">Comprar ahora</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="price-box active">
               <div class="price-empty"></div>
               <div class="price-quantity">
                  <div class="qnty-box">
                     <div class="box-element">
                        <h5>$450,000 COP</h5>
                        <p>Semestral</p>
                     </div>
                  </div>
                  <div class="price-dtl">
                     <ul>
                        <li class="first-child">Acceso ilimitado</li>
                        <li>Entrenador personal 2 veces al mes</li>
                        <li>Rutinas de musculación</li>
                        <li>Ejercicios funcionales</li>
                        <li>Clases de boxeo y fitness</li>
                     </ul>
                     <div class="price-btn bttn">
                        <button type="submit" class="btn btn-primary">Comprar ahora</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="price-box">
               <div class="price-empty"></div>
               <div class="price-quantity">
                  <div class="qnty-box">
                     <div class="box-element">
                        <h5>$850,000 COP</h5>
                        <p>Anual</p>
                     </div>
                  </div>
                  <div class="price-dtl">
                     <ul>
                        <li class="first-child">Acceso ilimitado</li>
                        <li>Entrenador personal mensual</li>
                        <li>Rutinas de musculación</li>
                        <li>Ejercicios funcionales</li>
                        <li>Clases de boxeo, yoga y spinning</li>
                     </ul>
                     <div class="price-btn bttn">
                        <button type="submit" class="btn btn-primary">Comprar ahora</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>-->

<!--  -->
<div class="schedule-area bg2 parallax pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20">
                  <div style="width:60px;height:3px;background:#1a3cff;margin:0 auto;border-radius:3px;"></div>
               </div>
               <h3>class schedule</h3>
               <p>make yourself stronger than your excuses</p>
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
               <li class="nav-item full-width"><a href="" data-target="#level7" data-toggle="tab" class="nav-link small text-uppercase ">sunday</a></li>
            </ul>
            <div id="tabsJustifiedContent" class="tab-content">

               <!--LUNES-->

               <div id="level1" class="tab-pane fade active show">
                  <div class="schdl-box">
                     <h5>Full Body</h5>
                     <p class="mb-0">06.00 am – 07.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07.00 am – 08.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">08.00 am – 09.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 10.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">10.00 am – 11.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">04.00 pm – 05.00pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Full Body Kids</h5>
                     <p class="mb-0">05.00 pm – 06.00pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Funtional beats</h5>
                     <p class="mb-0">06:30  – 07.30 </p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07.00 pm – 08.00pm</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">08.00 pm – 09.00pm</p>
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
                     <p class="mb-0">7:00 am – 8:00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>Down Force</h5>
                     <p class="mb-0">8:00 am – 9:00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">9:00 am – 11.00am</p>
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
                     <p class="mb-0">5:00 am – 6:00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 10.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>crosfit</h5>
                     <p class="mb-0">10.00 am – 11.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">1.00 am – 12.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>fitness</h5>
                     <p class="mb-0">04.00 pm – 05.00pm</p>
                  </div>
               </div>

               <!--JUEVES-->

               <div id="level4" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>boxing</h5>
                     <p class="mb-0">06.00 am – 07.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07.00 am – 08.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">1.00 am – 12.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>fitness</h5>
                     <p class="mb-0">04.00 pm – 05.00pm</p>
                  </div>
               </div>
               <div id="level5" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>boxing</h5>
                     <p class="mb-0">06.00 am – 07.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">07.00 am – 08.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>bodybuiling</h5>
                     <p class="mb-0">08.00 am – 09.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 10.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>crosfit</h5>
                     <p class="mb-0">10.00 am – 11.00am</p>
                  </div>
               </div>
               <div id="level6" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 10.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>crosfit</h5>
                     <p class="mb-0">10.00 am – 11.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">1.00 am – 12.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>fitness</h5>
                     <p class="mb-0">04.00 pm – 05.00pm</p>
                  </div>
               </div>
               <div id="level7" class="tab-pane fade">
                  <div class="schdl-box">
                     <h5>bodybuiling</h5>
                     <p class="mb-0">08.00 am – 09.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">09.00 am – 10.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>crosfit</h5>
                     <p class="mb-0">10.00 am – 11.00am</p>
                  </div>
                  <div class="schdl-box">
                     <h5>-----</h5>
                     <p class="mb-0">1.00 am – 12.00am</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="dwnload">
               <a href="#"><span><i class="fa fa-download" aria-hidden="true"></i></span>download our full class schedule</a>
            </div>
         </div>
      </div>
   </div>
</div>
<!--<div class="product-area pad90">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="section-title text-center">
               <div class="title-bar full-width mb20">
                  <div style="width:60px;height:3px;background:#1a3cff;margin:0 auto;border-radius:3px;"></div>
               </div>
               <h3>special products</h3>
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
                           <a href="assets/images/price/big1.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/1.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
                           <a href="assets/images/price/big2.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/2.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
                           <a href="assets/images/price/big3.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/3.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
                           <a href="assets/images/price/big4.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/4.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
                           <a href="assets/images/price/big3.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/3.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
                           <a href="assets/images/price/big4.jpg')}}">
                           <img src="{{url('template/website/assets/images/price/4.jpg')}}" alt="price img"><i class=" ovrlay fa fa-search"></i></a>
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
</div>-->


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
            <div style="background:rgba(20,20,40,0.8);border-radius:20px;padding:35px 20px;text-align:center;border-left:4px solid #00f0ff;backdrop-filter:blur(15px);transition:0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
               <i class="fa fa-map-marker" style="font-size:2.5rem;background:linear-gradient(90deg,#8a2be2,#00f0ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
               <h4 style="color:#fff;font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin:15px 0 10px;">Ubicación</h4>
               <p style="color:#aaa;font-size:0.95rem;margin:0;">Tunja, Boyacá — Colombia</p>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 mb-4">
            <div style="background:rgba(20,20,40,0.8);border-radius:20px;padding:35px 20px;text-align:center;border-left:4px solid #8a2be2;backdrop-filter:blur(15px);transition:0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
               <i class="fa fa-phone" style="font-size:2.5rem;background:linear-gradient(90deg,#00f0ff,#8a2be2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;"></i>
               <h4 style="color:#fff;font-size:1.1rem;font-weight:700;text-transform:uppercase;letter-spacing:2px;margin:15px 0 10px;">Teléfono</h4>
               <p style="color:#aaa;font-size:0.95rem;margin:0;">
                  <a href="tel:+573214978403" style="color:#aaa;text-decoration:none;">+57 321 497 8403</a>
               </p>
            </div>
         </div>

         <div class="col-md-4 col-sm-6 mb-4">
            <div style="background:rgba(20,20,40,0.8);border-radius:20px;padding:35px 20px;text-align:center;border-left:4px solid #00f0ff;backdrop-filter:blur(15px);transition:0.3s;" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
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
            <a href="https://wa.me/573214978403" target="_blank"
               style="display:inline-block;padding:15px 40px;border-radius:30px;background:linear-gradient(90deg,#25d366,#128c7e);color:#fff;font-weight:700;font-size:1rem;text-transform:uppercase;letter-spacing:1px;text-decoration:none;transition:0.3s;"
               onmouseover="this.style.transform='translateY(-3px)'"
               onmouseout="this.style.transform='translateY(0)'">
               <i class="fa fa-whatsapp" style="margin-right:8px;font-size:1.2rem;color:#fff;"></i>
               Escríbenos por WhatsApp
            </a>
         </div>
      </div>

   </div>
</div>
@endsection