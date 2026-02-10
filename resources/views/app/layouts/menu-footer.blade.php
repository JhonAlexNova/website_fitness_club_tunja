<div class="fixed bottom-0 left-0 right-0 z-40">
    <div class="container bg-p2 px-6 py-3 rounded-t-2xl flex justify-around items-center dark:bg-p1">
   <!--  <a href="{{url('app')}}" class="flex justify-center items-center text-center flex-col gap-1">
        <div class="flex justify-center items-center p-3 rounded-full bg-p1 dark:bg-p2">
        <i class="ph ph-house text-xl !leading-none text-white"></i>
        </div>
        <p class="text-xs text-white font-semibold dark:text-color10">Inicio</p>
    </a> -->
    <a href="{{url('app/clases')}}" class="flex justify-center items-center text-center flex-col gap-1">
        <div class="flex justify-center items-center p-3 rounded-full bg-white dark:bg-color10">
        <i class="ph ph-squares-four text-xl !leading-none dark:text-white"></i>
        </div>
        <p class="text-xs text-white font-semibold dark:text-color10">
        Clases
        </p>
    </a>
    <a href="{{url('app/perfil')}}" class="flex justify-center items-center text-center flex-col gap-1">
        <div class="flex justify-center items-center p-3 rounded-full bg-p1 dark:bg-p2">
        <i class="ph ph-users-three text-xl !leading-none dark:text-color10"></i>
        </div>
        <p class="text-xs text-white font-semibold dark:text-color10">
        Perfil
        </p>
    </a>
    <a href="javascript:void(0);"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="flex justify-center items-center text-center flex-col gap-1">
        <div class="flex justify-center items-center p-3 rounded-full bg-white dark:bg-color10">
        <i class="ph ph-users-three text-xl !leading-none dark:text-white"></i>
        </div>
        <p class="text-xs text-white font-semibold dark:text-color10">Salir</p>
    </a>
    </div>
</div>