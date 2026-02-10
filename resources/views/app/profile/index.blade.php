@extends("app.layouts.app")
@push("page_css")
<style>
  .text-p1 {
      color: rgb(255 255 255);
  }
</style>
@endpush
@section("content")
<div class="relative z-10 pb-20">
      <!-- Absolute Items Start -->
      
      <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
      <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
      <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
      <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
      <!-- Absolute Items End -->

      <!-- Page Title Start -->
      <div class="relative z-10 px-6">
        <div class="flex justify-between items-center gap-4">
          <div class="flex justify-start items-center gap-4">
           <!--  <a href="{{url('app')}}" class="bg-white size-8 rounded-full flex justify-center items-center text-xl dark:bg-color10">
              <i class="ph ph-caret-left"></i>
            </a> -->
            <h2 class="text-2xl font-semibold text-white">Mi perfil</h2>
          </div>
          <div class="flex justify-start items-center gap-2">
            <div class="relative">
              <button class="border border-color24 p-2 rounded-full flex justify-center items-center bg-color24 relative quizDetailsMoreOptionsModalOpenButton">
                <i class="ph ph-dots-three text-white"></i>
              </button>
              <div class="absolute top-12 right-0 z-40 min-w-48 modalClose duration-500 bg-white dark:bg-color9 p-5 rounded-xl shadow6 quizDetailsMoreOptionsModal">
                <div class="flex justify-start items-center gap-3 pb-3 cursor-pointer">
                  <div class="text-p2 dark:text-white dark:bg-color24 dark:border-color18 border border-color16 p-2 rounded-full flex justify-center items-center bg-color14 text-sm">
                    <i class="ph ph-user"></i>
                  </div>
                  <p class="text-sm">
                    <a href="{{url('app/editar-perfil')}}">Editar perfil</a>
                  </p>
                </div>
                <div class="flex justify-start items-center gap-3 pt-3 border-y border-dashed border-color21 dark:border-color24 pb-3 cursor-pointer">
                  <div class="text-p2 dark:text-white dark:bg-color24 dark:border-color18 border border-color16 p-2 rounded-full flex justify-center items-center bg-color14 text-sm">
                    <i class="ph ph-gear"></i>
                  </div>
                  <p class="text-sm text-nowrap">
                    <a href="{{url('app/editar-contrasena')}}">Cambiar contraseña</a>
                  </p>
                </div>
               
              </div>
            </div>
          </div>
        </div>
        <!-- Page Title End -->

        <!-- User Profile Image Start -->
        <div class="flex justify-center items-end pt-16 gap-8">
          <div class="flex justify-center items-center gap-1 bg-p2 bg-opacity-10 px-3 py-1 rounded-full border border-p2 border-opacity-20 mb-6 dark:bg-bgColor14 dark:border-bgColor16">
            <i class="ph-fill text-p1 ph-heart"></i>
            <p class="text-sm text-p2 dark:text-white">200</p>
          </div>
          <div class="relative size-40 flex justify-center items-center">
            @if(Auth::user()->foto_perfil)
                <img src="{{url('storage',Auth::user()->foto_perfil)}}" alt="" class="size-32 bg-[#B190B6] rounded-full overflow-hidden">
            @else
                <img src="{{url('img/avatar.png')}}" alt="" class="size-32 bg-[#B190B6] rounded-full overflow-hidden">
            @endif

            <img src="{{url('template/app/assets/images/user-progress.svg')}}" alt="" class="absolute top-0 left-0 right-0">
            <img src="{{url('template/app/assets/images/badge1.png')}}" alt="" class="absolute -bottom-2 left-[60px]">
          </div>
          <div class="flex justify-center items-center gap-1 bg-p2 bg-opacity-10 px-3 py-1 rounded-full border border-p2 border-opacity-20 mb-6 dark:bg-bgColor14 dark:border-bgColor16">
            <i class="ph text-p1 ph-trophy"></i>
            <p class="text-sm text-p2 font-semibold dark:text-white">#1</p>
          </div>
        </div>
        <!-- User Profile Image End -->
        <div class="flex justify-center items-center pt-5 flex-col pb-5">
          <div class="flex justify-start items-center gap-1 text-2xl">
            <p class="font-semibold"> {{ Auth::user()->primer_nombre }} {{ Auth::user()->segundo_nombre }} </p>
            <i class="ph-fill ph-seal-check text-p1"></i>
          </div>
          <p class="text-color5 pt-1 dark:text-bgColor20 font-semibold">
            {{ Auth::user()->email }}
          </p>
        </div>

        <!-- datos generales -->
        <div class="grid grid-cols-2 gap-5">
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon1.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Peso</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1"> {{ Auth::user()->peso }} Kilos </p>
                  </div>
                </div>
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon2.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Talla</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1">{{ Auth::user()->talla }}</p>
                  </div>
                </div>
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon3.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Porcentaje grasa</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1"> {{ Auth::user()->porcentaje_grasa }} </p>
                  </div>
                </div>
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon4.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Porcentaje musculo</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1"> {{ Auth::user()->porcentaje_musculo }} </p>
                  </div>
                </div>
              </div>
        <!--  -->

        
        
        
      </div>
    </div>
    @include("app.layouts.menu-footer")
    @include("app.layouts.sidebar")
@endsection