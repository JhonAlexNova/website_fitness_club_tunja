<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>@yield("title",'Fitnnes Club')</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="{{ url('template/app/assets/images/logo.png')}}" type="image/x-icon">
      <link rel="stylesheet" href="{{ url('template/app/assets/css/swiper.min.css')}}">
      
      <link rel="stylesheet" href="{{url('libs/font-awesome-4.7.0/css/font-awesome.min.css')}}">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

      <script src="{{url('template/app/@phosphor-icons/web@2.1.1/src/index.js')}}"></script>
      <link rel="manifest" href="{{ url('template/app/manifest.json')}}">
      <link href="{{ url('template/app/style.css')}}" rel="stylesheet">
      <link rel="stylesheet" href="/application/css/app.css?v={{env('V_CACHE')}}">
      <style>
         .animation-success {
         z-index: 9999;
         position: fixed;
         z-index: 9999;
         background: #fff;
         top: 0;
         left: 0;
         right: 0;
         /* display: none; */
         height: 100%;
         }
         .title{
            color:#000
         }
      </style>
      @stack('page_css')

      
   </head>
   <body class="-z-20">
      <div class="">

      @if(session()->has('flash_notification'))
      <div class="animation-success" style="display:{{session()->has('flash_notification')?'block':'none'}}">
         <div class="flex justify-center items-center flex-col h-screen px-6">
            <div class="wave-animation">
               <div class="size-32 rounded-full bg-g60 flex justify-center items-center">
                  <i class="ph ph-check relative z-[500] text-6xl text-white"></i>
               </div>
               <div class="waves wave-1"></div>
               <div class="waves wave-2"></div>
               <div class="waves wave-3"></div>
            </div>
            <div class="flex justify-center items-center flex-col py-20">
               <h1 class="text-2xl font-semibold text-p2 dark:text-p1">
                  ¡Mensaje!
               </h1>
               <p class="text-xs pt-3 px-4 text-center">
                  {{ session('flash_notification')->first()->message }}
               </p>
            </div>
            <div class="w-full">
               <a href="javascript:void(0);" class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1 btnCloseNotificationSuccess">Aceptar</a>
            </div>
         </div>
      </div>
      @endif
      <!-- Absolute Items Start -->
      
      <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
      <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
      <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
      <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
      <!-- Absolute Items End -->
      <!-- Sidebar End -->
      <!-- Logout Modal Start -->
      <div class="hidden inset-0 withdrawModal z-50">
         <div class="bg-black opacity-40 absolute inset-0 container"></div>
         <div class="flex justify-end items-end flex-col h-full">
            <div class="container relative">
               <img src="{{url('template/app/assets/images/modal-bg-white.png')}}" alt="" class="dark:hidden">
               <img src="{{url('template/app/assets/images/modal-bg-black.png')}}" alt="" class="hidden dark:block">
               <div class="bg-white dark:bg-color1 relative z-40 overflow-auto pb-8">
                  <div class="px-6 pt-8 border-b border-color21 dark:border-color24 border-dashed pb-5 mx-6">
                     <p class="text-2xl text-p1 text-center font-semibold">Log Out</p>
                  </div>
                  <div class="pt-5 px-6">
                     <p class="text-color5 dark:text-white pb-8 text-center">
                        Are you sure you want to log out?
                     </p>
                     <div class="flex justify-between items-center gap-3">
                        <button class="withdrawModalCloseButton border border-color16 bg-color14 rounded-full py-3 text-p2 text-sm font-semibold text-center block dark:border-p1 w-full dark:text-white">
                        Cancel
                        </button>
                        <a href="sign-in.html" class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block dark:bg-p1 w-full">
                        Yes, Logout
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Logout Modal End -->
       <div id="content-application">
          @yield("content")
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
       </div>
      <!-- Js Dependencies -->
      <script src="{{url('template/app/assets/js/plugins/plugins.js')}}"></script>
      <script src="{{url('template/app/assets/js/plugins/plugin-custom.js')}}"></script>
      <script src="{{url('template/app/assets/js/plugins/circle-slider.js')}}"></script>
      <!-- swet alert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <!--  -->
      <script src="{{url('template/app/assets/js/main.js')}}"></script>
      <!-- <script defer="" src="{{url('template/app/assets/js/main.js')}}"></script> -->
      <script>
        $(document).on("click",".btnCloseNotificationSuccess",function(){
          $(".animation-success").hide();
        })
        $(document).on('click','.quizDetailsMoreOptionsModalOpenButton', function () {
    $(".quizDetailsMoreOptionsModal").toggleClass("modalClose modalOpen");
  });

      </script>

      @stack("page_scripts")
   </body>
</html>