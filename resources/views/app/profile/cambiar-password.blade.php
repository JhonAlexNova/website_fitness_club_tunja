@extends("app.layouts.app")
@section("content")
    <div class="container min-h-dvh relative overflow-hidden py-8 px-6 dark:text-white dark:bg-color1">
      <!-- Absolute Items Start -->
      <img src="assets/images/header-bg-2.png" alt="" class="absolute top-0 left-0 right-0 -mt-6">
      <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
      <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
      <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
      <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
      <!-- Absolute Items End -->

      <!-- Page Title Start -->
      <div class="flex justify-start items-center gap-4 relative z-10">
        <a href="{{url('app/perfil')}}" class="bg-white p-2 rounded-full flex justify-center items-center text-xl dark:bg-color10">
          <i class="ph ph-caret-left"></i>
        </a>
        <h2 class="text-2xl font-semibold text-white">Actualizar perfil</h2>
      </div>
      <!-- Page Title End -->

      <!-- Formulario de actualización -->
      <form action="{{route('app.perfil.update',Auth::user()->id)}}" method="POST" class="relative z-10" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="bg-white py-8 px-6 rounded-xl mt-12 dark:bg-color10">
          <div class="flex flex-col gap-3 text-center">
            <h3 class="text-xl font-semibold">Cambiar Contraseña</h3>
            <p class="text-color5 text-sm dark:text-color18">
                Asegúrate de usar una contraseña segura.
            </p>
          </div>

          <div class="pt-8">
                @include("app.profile.fields-perfil")      
          </div>
        </div>

        <button type="submit" style="width:100%" class="bg-p2 rounded-full py-3 text-white text-sm font-semibold text-center block mt-8 dark:bg-p1">
                Actualizar
        </button>
      </form>
    </div>
@endsection
