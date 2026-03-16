@extends("app.layouts.app")

@push("page_css")
@endpush

@section("content")

<div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-color1">

<div class="relative z-10 px-6">

<div class="flex justify-between items-center gap-4">
<div class="flex justify-start items-center gap-4">

<a href="{{url('app/clases')}}" class="bg-white size-8 rounded-full flex justify-center items-center text-xl dark:bg-color10">
<i class="ph ph-caret-left"></i>
</a>

<h2 class="text-2xl font-semibold text-white">Detalles clase</h2>

</div>
</div>


<div class="rounded-2xl overflow-hidden shadow2 mt-16">

<div class="p-5 bg-white dark:bg-color10">

<div class="flex justify-between items-center">

<div class="flex justify-start items-center gap-2">

<div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
<p class="font-semibold text-xs">
{{ Carbon\Carbon::parse($clase['fecha'])->format('d M') }}
</p>
</div>

<div>
<p class="font-semibold text-xs">{{ $clase->clase->nombre }}</p>
</div>

</div>


<div class="flex justify-start items-center gap-1">

<p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
{{ Carbon\Carbon::parse($clase['fecha'])->format('H') }}
</p>

<p class="text-p2 text-base font-semibold dark:text-p1">:</p>

<p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
{{ Carbon\Carbon::parse($clase['fecha'])->format('i') }}
</p>

</div>

</div>


<div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap mt-2">

<p>{{ $clase["cantidad_inscritos"] }}</p>

<div class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full"></div>

<p>{{ $clase["cupo_maximo"] }}</p>

</div>



<form action="{{ route('app.reservas.store') }}" method="post" class="formInscripcionClase">

@csrf

<input type="hidden" name="fecha_reserva" value="{{$clase->fecha}}">
<input type="hidden" name="tipo" value="{{$tipo}}">
<input type="hidden" name="horario_clase_id" value="{{$clase->id}}">


@if($clase->cantidad_inscritos >= $clase->cupo_maximo)

<div class="py-3 text-center bg-gray-400 rounded-full text-sm font-semibold text-white block w-full">
Clase llena
</div>


@elseif(is_null($reserva))

<button type="button"
class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block btnInscripcionClase w-full">
Inscribirme
</button>


@elseif($reserva->estado=="Cancelada")

<button type="button"
class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block btnInscripcionClase w-full">
Volver a inscribirme
</button>


@elseif($reserva->estado=="Reservada")

<a href="{{ route('app.reserva.cancelar',$reserva->id) }}"
class="btnCancelarReserva py-3 text-center bg-red-500 rounded-full text-sm font-semibold text-white block w-full">
Cancelar reserva
</a>

@endif

</form>



<div class="pt-5 flex justify-between items-center border-t border-dashed border-black dark:border-color24 border-opacity-10 mt-5">

<div class="flex justify-start items-center gap-1">
<i class="ph ph-trophy text-p1"></i>
</div>

<div class="flex justify-start items-center gap-2">
<i class="ph ph-share-network"></i>
<i class="ph ph-bell-ringing"></i>
</div>

</div>


</div>
</div>


</div>
</div>


@include("app.layouts.menu-footer")

@endsection



@push("page_scripts")

<script>

$(document).on("click",".btnCancelarReserva",function(event){

event.preventDefault();

Swal.fire({
title: "¡Advertencia!",
text: "¿Está seguro de cancelar la reservación de la clase?",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Confirmar"
}).then((result) => {

if (result.isConfirmed) {
window.location.href=$(this).attr("href");
}

});

});



$(document).on("click",".btnInscripcionClase",function(event){

Swal.fire({
title: "¡Advertencia!",
text: "¿Está seguro(a) de inscribirse a la clase?",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Confirmar"
}).then((result) => {

if (result.isConfirmed) {
$(".formInscripcionClase").submit();
}

});

});

</script>

@endpush