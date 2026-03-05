@extends("app.layouts.app")
@push("page_css")

@endpush
@section("content")

    <div class="container min-h-dvh relative overflow-hidden py-8 dark:text-white dark:bg-color1">
      <!-- Absolute Items Start -->
      <img src="assets/images/header-bg-1.png" alt="" class="absolute top-0 left-0 right-0 -mt-12">
      <div class="absolute top-0 left-0 bg-p3 blur-[145px] h-[174px] w-[149px]"></div>
      <div class="absolute top-40 right-0 bg-[#0ABAC9] blur-[150px] h-[174px] w-[91px]"></div>
      <div class="absolute top-80 right-40 bg-p2 blur-[235px] h-[205px] w-[176px]"></div>
      <div class="absolute bottom-0 right-0 bg-p3 blur-[220px] h-[174px] w-[149px]"></div>
      <!-- Absolute Items End -->

      <!-- Page Title Start -->
      <div class="relative z-10 px-6">
        <div class="flex justify-between items-center gap-4">
          <div class="flex justify-start items-center gap-4">
            <a href="{{url('app/clases')}}" class="bg-white size-8 rounded-full flex justify-center items-center text-xl dark:bg-color10">
              <i class="ph ph-caret-left"></i>
            </a>
            <h2 class="text-2xl font-semibold text-white">Detalles clase</h2>
            
          </div>
          <div class="flex justify-start items-center gap-2">
           
          </div>
        </div>
        <!-- Page Title End -->
        <div class="rounded-2xl overflow-hidden shadow2 mt-16">
          <div class="p-5 bg-white dark:bg-color10">
            <div class="flex justify-between items-center">
              <div class="flex justify-start items-center gap-2">
                <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                    <p class="font-semibold text-xs">{{ Carbon\Carbon::parse($clase['fecha'])->format('d M') }}</p>
                    <p class="text-[10px]"></p>
                </div>
                <div class="">
                  <p class="font-semibold text-xs">  {{ $clase->clase->nombre }} </p>
                  <p class="text-xs"></p>
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
                <p class="text-p2 text-base font-semibold dark:text-p1">:</p>
                <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                {{ Carbon\Carbon::parse($clase['fecha'])->format('s') }}
                </p>
              </div>
            </div>

            <div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap mt-2">
              <p> {{ $clase["cantidad_inscritos"] }} </p>
              <div class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full after:absolute after:h-1 after:w-[40%] after:bg-p2 after:dark:bg-p1 after:rounded-full"></div>
              <p> {{ $clase["cupo_maximo"] }} </p>
            </div>
            <form action="{{ route('app.reservas.store') }}" method="post" class="formInscripcionClase">
                @csrf
                <input type="hidden" value="{{$clase->fecha}}" name="fecha_reserva">
                <input type="hidden" value="{{$tipo}}" name="tipo">
                <input type="hidden" value="{{$clase->id}}" name="horario_clase_id">
                @if($clase->cupos_disponibles <= 0)
                    <div class="py-3 text-center bg-gray-400 rounded-full text-sm font-semibold text-white block w-full">
                        Clase llena
                    </div>
                @elseif(is_null($reserva))
                    <button type="button" class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block btnInscripcionClase w-full">
                        Inscribirme
                    </button>
                @elseif($reserva->estado=="Cancelada")
                  <button  type="button" class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block btnInscripcionClase w-full">
                      Volver a Inscribirme
                  </button>
                @elseif($reserva->estado=="Reservada")
                  <button type="button" class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block btnCancelarReserva w-full">
                      Cancelar reserva      
                  </button>
                @endif
            </form>

            <form action="{{ route('app.reservas.store') }}" method="post" class="formCancelarReserva">
              @csrf
              <input type="hidden" name="cancelar_reserva" value="1">
              <input type="hidden" name="horario_clase_id" value="{{$clase->id}}">
              <input type="hidden" name="tipo" value="{{$tipo}}">
              <input type="hidden" name="fecha_reserva" value="{{$clase->fecha}}">
            </form>

          

            <div class="pt-5 flex justify-between items-center border-t border-dashed border-black dark:border-color24 border-opacity-10 mt-5">
              <div class="flex justify-start items-center gap-1">
                <i class="ph ph-trophy text-p1"></i>
                <p class="text-xs"></p>
              </div>
              <div class="flex justify-start items-center gap-2">
                <i class="ph ph-share-network"></i>
                <button class="setReminderModalOpenButton">
                  <i class="ph ph-bell-ringing"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

       <!--  <div class="py-4 px-5 rounded-2xl border border-color21 bg-white mt-8 dark:bg-color11 quiz-details">
          <p class="font-semibold pb-3 border-b border-dashed border-color21 dark:border-color24">
            Quiz Details
          </p>
          <div class="flex justify-start items-center gap-2 pt-3">
            <div class="flex justify-center items-center text-white bg-p1 p-2 rounded-full dark:bg-p1 icon">
              <i class="ph ph-scroll"></i>
            </div>
            <p class="text-sm text-color5 dark:text-bgColor5 detailsShort">
              Challenge your of historical events, figures, and milestones with
              our
              <button class="text-p2 underline dark:text-p1 quizDetailsShowButton">
                More
              </button>
            </p>
            <div class="text-sm flex-col gap-2 details">
              <p class="">
                When creating a quiz description or brief overview for your app
                UI page, aim to provide concise yet informative details about
                the quiz. Here's an example of a quiz description: Quiz Title:
                History Buffs Trivia
              </p>
              <p class="">
                Description: Challenge your knowledge of historical events,
                figures, and milestones with our History Buffs Trivia quiz! Test
                yourself with a variety of thought-provoking questions spanning
                different eras, civilizations, and key moments in history.
                Whether you're a history enthusiast or looking to learn
                something new, dive into this quiz for an engaging and
                enlightening experience.
              </p>
              <p>
                Description: Challenge your knowledge of historical events,
                figures, and milestones with our History Buffs Trivia quiz! Test
                yourself with a variety of thought-provoking questions spanning
                different eras, civilizations, and key moments in history.
                Whether you're a history enthusiast or looking to learn
                something new, dive into this quiz for an engaging and
                enlightening experience.
              </p>
              <p class="font-semibold">Quiz Details:</p>
              <ul class="list-disc ml-4">
                <li>Number of Questions: 30</li>
                <li>Difficulty Level: Moderate</li>
                <li>
                  Categories: World History, Famous Figures, Events & Dates
                </li>
              </ul>
            </div>
          </div>
        </div> -->

        <!-- <div class="quizDetailsTab pt-8">
          <ul class="flex justify-start items-center tab-button text-center font-semibold">
            <li id="tabOne" class="tabButton activeTabButton cursor-pointer">
              Winning
            </li>
            <li id="tabTwo" class="tabButton cursor-pointer">Leaderboard</li>
          </ul>

          <div class="pt-8">
            <div class="tab-content activeTab" id="tabOne_data">
              <div class="text-sm font-semibold">
                <div class="flex justify-between items-center py-2 px-5 bg-p2 text-white rounded-t-2xl">
                  <p>Rank</p>
                  <p>Winning</p>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-dashed border-color21 dark:border-color24 mx-5">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-trophy text-p1 text-lg"></i>
                    <p>1</p>
                  </div>
                  <p>$2499</p>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-dashed border-color21 dark:border-color24 mx-5">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-trophy text-p1 text-lg"></i>
                    <p>2</p>
                  </div>
                  <p>$2300</p>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-dashed border-color21 dark:border-color24 mx-5">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-trophy text-p1 text-lg"></i>
                    <p>3</p>
                  </div>
                  <p>$2150</p>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-dashed border-color21 dark:border-color24 mx-5">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-trophy text-p1 text-lg"></i>
                    <p>4</p>
                  </div>
                  <p>$1900</p>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-dashed border-color21 dark:border-color24 mx-5">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-trophy text-p1 text-lg"></i>
                    <p>5</p>
                  </div>
                  <p>$1800</p>
                </div>
              </div>
            </div>
            <div class="tab-content hiddenTab" id="tabTwo_data">
              <table class="text-sm font-semibold w-full text-center">
                <tr class="bg-p2 text-white w-full">
                  <th class="rounded-tl-xl text-start">
                    <p class="py-2 pl-5">Name</p>
                  </th>
                  <th class="">
                    <p class="py-2 text-nowrap">Final Marks</p>
                  </th>
                  <th class="">
                    <p class="py-2">Rank</p>
                  </th>
                  <th class="rounded-tr-xl">
                    <p class="py-2">Winnding</p>
                  </th>
                </tr>
                <tr class="w-full border-b border-color21 dark:border-color24 border-dashed">
                  <td>
                    <div class="flex justify-start items-center gap-2 py-3">
                      <img src="assets/images/user-img-1.png" alt="" class="size-8 rounded-full object-cover">
                      <p>Lunar Fang</p>
                    </div>
                  </td>
                  <td>
                    <p class="py-3">40</p>
                  </td>
                  <td><p class="py-3">1</p></td>
                  <td><p class="py-3">$226</p></td>
                </tr>
                <tr class="w-full border-b border-color21 dark:border-color24 border-dashed">
                  <td>
                    <div class="flex justify-start items-center gap-2 py-3">
                      <img src="assets/images/user-img-2.png" alt="" class="size-8 rounded-full object-cover">
                      <p>Lunar Fang</p>
                    </div>
                  </td>
                  <td>
                    <p class="py-3">40</p>
                  </td>
                  <td><p class="py-3">2</p></td>
                  <td><p class="py-3">$226</p></td>
                </tr>
                <tr class="w-full border-b border-color21 dark:border-color24 border-dashed">
                  <td>
                    <div class="flex justify-start items-center gap-2 py-3">
                      <img src="assets/images/user-img-3.png" alt="" class="size-8 rounded-full object-cover">
                      <p>Lunar Fang</p>
                    </div>
                  </td>
                  <td>
                    <p class="py-3">40</p>
                  </td>
                  <td><p class="py-3">3</p></td>
                  <td><p class="py-3">$226</p></td>
                </tr>
              </table>
              <a href="leader-board.html" class="text-center pt-3 block font-semibold text-p2 dark:text-p1">See All</a>
            </div>
          </div>
        </div> -->
      </div>
    </div>

    <!-- <div class="hidden inset-0 z-40 confirmationModal">
      <div class="container bg-black dark:bg-white dark:bg-opacity-30 bg-opacity-40 flex justify-center items-center h-full px-6">
        <div class="bg-white dark:bg-color10 p-5 rounded-xl w-full dark:text-white">
          <div class="flex justify-between items-center pb-4">
            <p class="text-lg font-semibold">Confirmation</p>
            <button class="p-2 flex justify-center items-center rounded-full border border-color16 confirmationModalCloseButton dark:border-bgColor16">
              <i class="ph ph-x"></i>
            </button>
          </div>
          <div class="py-4 border-y border-dashed border-color21 dark:border-color24">
            <div class="flex justify-between items-center">
              <p class="text-color5 dark:text-bgColor5">Entry Fee :</p>
              <p class="font-semibold">Rs. 25.00</p>
            </div>
            <div class="flex justify-between items-center pt-3">
              <p class="text-color5 dark:text-bgColor5">Joining Offer :</p>
              <p class="font-semibold">Rs. 15.00</p>
            </div>
          </div>
          <div class="flex justify-between items-end py-4">
            <div class="">
              <p class="font-semibold">To Pay :</p>
              <p class="text-xs text-color5 dark:text-bgColor5">
                inclusive of taxes
              </p>
            </div>
            <p class="text-sm font-semibold text-p2 dark:text-p1">Rs. 15.00</p>
          </div>
          <a href="quiz-1.html" class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block w-full dark:bg-p1">
            Inscribirme
          </a>
          <div class="flex justify-start items-start gap-2 pt-2">
            <div class="text-lg">
              <i class="ph ph-check-square"></i>
            </div>
            <p class="text-xs text-color5 dark:text-bgColor5">
              You agree to all terms & conditions and also agree to be contacted
              by company and their pertners
            </p>
          </div>
        </div>
      </div>
    </div> -->

   <!--  <div class="hidden inset-0 z-40 setReminderModal">
      <div class="container bg-black dark:bg-white dark:bg-opacity-30 bg-opacity-40 flex justify-center items-center h-full px-6">
        <div class="bg-white dark:bg-color10 p-5 rounded-xl w-full dark:text-white">
          <div class="flex justify-between items-center pb-4 border-b border-dashed border-color21 dark:border-color24">
            <p class="text-lg font-semibold">Set Reminder</p>
            <button class="p-2 flex justify-center items-center rounded-full border border-color16 setReminderModalCloseButton dark:border-bgColor16">
              <i class="ph ph-x"></i>
            </button>
          </div>

          <p class="text-xs text-color5 dark:text-bgColor5 py-4">
            You agree to all terms & conditions and also agree to be contacted
            by company and their pertners
          </p>

          <div class="flex justify-between items-center gap-3">
            <button class="py-3 text-center border-color16 bg-color14 rounded-full text-sm font-semibold text-p2 dark:text-p1 block w-full dark:border-bgColor16 dark:bg-bgColor14">
              Later
            </button>
            <button class="py-3 text-center bg-p2 rounded-full text-sm font-semibold text-white block w-full dark:bg-p1">
              Set Now
            </button>
          </div>
        </div>
      </div>
    </div>
 -->
 @include("app.layouts.menu-footer")
@endsection

@push("page_scripts")
<script>
  $(document).on("click",".btnCancelarReserva",function(event){
    Swal.fire({
      title: "¡Advertencia!",
      text: "Esta seguro de cancelar la reservación de la clase",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Confirmar"
    }).then((result) => {
      if (result.isConfirmed) {
       $(".formCancelarReserva").submit();
      }
    });

  });

  /* inscribir a clase */
  $(document).on("click",".btnInscripcionClase",function(event){
    Swal.fire({
      title: "¡Advertencia!",
      text: "¿Esta seguro(a) de inscribirse a la clase?",
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
  /*  */
</script>
@endpush
