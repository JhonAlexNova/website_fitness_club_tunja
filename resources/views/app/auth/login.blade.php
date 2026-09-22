<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('template/app/assets/images/logo.png')}}')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('template/app/assets/css/swiper.min.css')}}">
    <script src="%40phosphor-icons/web%402.1.1/src/index.js"></script>
    <link rel="manifest" href="manifest.json">
    <title>Fitnes Club</title>
    <link href="{{ url('/template/app/style.css')}}" rel="stylesheet">
    <link href="{{ url('/template/app/assets/css/login.css')}}" rel="stylesheet">
    <style>
      .bg-p2 {
        background-color: rgb(48 52 74) !important;
      }
    </style>
  </head>
  <body class="">
    <div class="min-h-dvh relative  py-8 px-6 dark:text-white dark:bg-color1">
      <!-- Absolute Items Start -->
      <img src="{{url('template/app/assets/images/header-bg-2.png')}}" alt="" class="img-login absolute top-0 left-0 right-0 -mt-6">
      <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
      <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
      <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
      <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
      <!-- Absolute Items End -->
      <!-- Page Title Start -->
      <div class="flex justify-start items-center gap-4 relative z-10">
        <a href="index.html" class="bg-white p-2 rounded-full flex justify-center items-center text-xl dark:bg-color10">
          <i class="ph ph-caret-left"></i>
        </a>
        <h2 class="text-2xl font-semibold text-white">Iniciar sesión</h2>
      </div>
      <!-- Page Title End -->
      <div class="content-form">
        <div class="container">
           <!-- Sign In Form Start -->
          <form class="login100-form validate-form relative z-10" method="post" action="{{ url('/login') }}">
            @csrf
            <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
              <div class="flex justify-between items-center">
                <a href="" class="text-center text-xl font-semibold text-p2 border-b-2 pb-2 border-p2 w-full dark:text-p1 dark:border-p1">Acceso</a>
                <a href="#" class="text-center text-xl font-semibold text-bgColor18 border-b-2 pb-2 border-bgColor18 w-full dark:text-color18 dark:border-color18">Registrarse</a>
              </div>

              <div class="pt-8">
                @error('email')
                      <span class="error invalid-feedback">{{ $message }}</span>
                  @enderror
                  @error('password')
                      <span class="error invalid-feedback">{{ $message }}</span>
                  @enderror
              </div>

              <div class="pt-8">
                <p class="text-sm font-semibold pb-2">Correo</p>
                <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
                  <input type="text" 
                      name="email"
                      value="{{ old('email') }}"
                      placeholder="Correo electronico"
                   class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18">
                  <i class="ph ph-envelope-simple text-xl text-bgColor18 !leading-none"></i>
                </div>
              </div>
              <div class="pt-4">
                <p class="text-sm font-semibold pb-2">Contraseña</p>
                <div class="flex justify-between items-center py-3 px-4 border border-color21 rounded-xl dark:border-color18 gap-3">
                  <input type="password" placeholder="*****" 
                   name="password" autocomple='new-password'
                    class="outline-none bg-transparent text-n600 text-sm placeholder:text-sm w-full placeholder:text-bgColor18 dark:text-color18 dark:placeholder:text-color18 passwordField">
                  <i class="ph ph-eye-slash text-xl text-bgColor18 !leading-none passowordShow cursor-pointer dark:text-color18"></i>
                </div>
              </div>
              <a href="forgot-password.html" class="text-end text-p2 text-sm font-semibold block pt-2 dark:text-p1">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" style="width:100%" class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-12 dark:bg-p1"> 
                Acceder
            </button>
          </form>
          <div class="relative z-10" style="display: none;">
            <div class="flex justify-center items-center my-8 gap-2">
              <div class="border-b border-color21 w-full dark:border-color18"></div>
              <p class="text-sm text-color1 text-nowrap dark:text-white">
                O continua con
              </p>
              <div class="border-b border-color21 w-full dark:border-color18"></div>
            </div>
            <div class="flex flex-col gap-4">
              <button class="flex justify-center items-center gap-3 py-3 border border-color21 text-sm font-semibold rounded-full bg-white dark:bg-color11 dark:border-color21">
                <img src="{{url('template/app/assets/images/google.png')}}" alt="">
                <p>Continue With</p>
              </button>
              
            </div>

            <p class="text-sm font-semibold text-center pt-5">
             
            </p>
          </div>
        </div>
      </div>
        
      <!-- Sign In Form End -->
    </div>

    <!-- Javascript Dependencies -->
    <script src="{{ url('template/app/assets/js/main.js')}}"></script>
  <script defer="" src="{{ url('template/index.js')}}"></script></body>
</html>
