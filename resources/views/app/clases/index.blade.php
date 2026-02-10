@extends("app.layouts.app")
@push('page_css')
<style>
        * {
            box-sizing: border-box;
            margin: 0; 
            padding: 0;
        }
       
        .fitness-schedule {
            background-color: #00bcd47a;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 20px;
            margin-top: 40px;
        }
        .header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }
        .header-title {
            flex-grow: 1;
            min-width: 200px;
        }
        .header-title h1 {
          color: white;
          font-size: 1.5rem;
          line-height: 1.2;
          font-size: 31px;
          
          font-family: "Anton", serif;
  font-weight: 400;
  font-style: normal;
      }

        span.titulo-horario {
            
            font-weight: bold;
            color: #1b3e63;
            font-weight: bold;
        }
        .header-icons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        .header-icons img {
            width: 300px;
        }
        .schedule-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .day-column {
            background-color: white;
            border-radius: 5px;
            overflow: hidden;
        }
        .day-header {
            text-align: center;
            padding: 5px;
            color: white;
            font-weight: bold;
        }
        .day-content {
            padding: 5px;
            text-align: center;
            color: #333;
            font-size: 0.8rem;
        }
        .day-content:nth-child(even) {
            background-color: #cadec4;
        }
        .day-header[data-day="SUN"] { background-color: #F23054; }
        .day-header[data-day="MON"] { background-color: #3C4858; }
        .day-header[data-day="TUE"] { background-color: #3C4858; }
        .day-header[data-day="WED"] { background-color: #3C4858; }
        .day-header[data-day="THU"] { background-color: #3C4858; }
        .day-header[data-day="FRI"] { background-color: #3C4858; }
        .day-header[data-day="SAT"] { background-color: #3C4858; }


        button#btnPrev, button#btnNext {
    background: #E91E63;
    padding: 0 10px;
    text-align: center;
    font-size: 13px;
    border-radius: 2px;
    color: #fff;
}

span#weekRange {
    background: #fff;
    padding: 0px 10px;
    font-size: 13px;
    border-radius: 3px;
    text-align:center
}

@media screen and (max-width: 480px) {
    span#weekRange {
      width: 100%;
  }
}
        
        @media screen and (max-width: 480px) {
            .schedule-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .day-column:nth-child(n+5) {
                grid-column: span 2;
            }

            
        }
        @media screen and (max-width: 480px) {
          .schedule-grid {
              display: block;
          }
          .day-column {
                margin: 20px 0;
            }
        }
    </style>
@endpush
@section("content")
 <!-- Page Title Start -->
 <div class="relative z-10 pb-20">
        <div class="flex justify-between items-center gap-4 px-6 relative z-20">
          <div class="flex justify-start items-center gap-2">
            <button class="sidebarModalOpenButton text-2xl text-white !leading-none">
              <i class="ph ph-list"></i>
            </button>
            <h2 class="text-2xl font-semibold text-white">Clases</h2>
          </div>
          <div class="flex justify-start items-center gap-2">
            <a href="" class="text-white border border-color24 p-2 rounded-full flex justify-center items-center bg-color24">
              <i class="ph ph-bell"></i>
            </a>
            <a href="{{url('app/perfil')}}" class="text-white border border-color24 p-2 rounded-full flex justify-center items-center bg-color24">
              <i class="ph ph-user"></i>
            </a>
          </div>
        </div>
        <!-- Page Title End -->

        <!-- Search Box Start -->
        
        <!-- Search Box End -->
        
        
        <div class="flex justify-between items-center pr-6 pt-8">
            
          </div>

          
        <div class="userProfileTab">
            
        <div class="flex justify-start items-center gap-3">
          <button id="btnPrev" class="tabButton px-4 py-2 bg-gray-200 rounded"> <i class="fa fa-chevron-left"></i> </button>
          <span id="weekRange"></span> <!-- Aquí se mostrará el rango de la semana -->
          <button id="btnNext" class="px-4 py-2 bg-gray-200 rounded"> <i class="fa fa-chevron-right"></i> </button>
        </div>

          <div class="pt-3">
            <div class="tab-content activeTab" id="tabOne_data">
              <div class="grid grid-cols-1 gap-5">
              <div class="fitness-schedule">
        <div class="header">
            <div class="header-title">
                <h1>Horario<br>Clases <span class="titulo-horario">Fitness</span>   Club</h1>
            </div>
            <div class="header-icons">
                <img src="{{url('img/imagen-head-horario.png')}}" alt="">
            </div>
        </div>

        <div class="schedule-grid">
          @foreach($clases as $index => $dia)
            <div class="day-column">
                <div class="day-header" data-day="SUN"> {{ $index }} </div>
                @foreach($dia as $dia)
                  <div class="day-content"> 
                    <a href="{{ route('clase.detalle', ['id' => $dia['id'], 'tipo' => $dia['tipo'], 'fecha' => $dia['tipo'] === 'recurrente' ? $dia['fecha_reserva'] : $dia['start']]) }}">
                      <i class="fa fa-hand-o-right" aria-hidden="true"></i>  {{ $dia["title"] }}  
                    </a>
                  </div>
                  <div class="day-content">
                      <span class="fecha">{{ Carbon\Carbon::parse($dia['start'])->format('d M') }} - {{ Carbon\Carbon::parse($dia['start'])->format('H.i') }}</span><br>
                      <span class="fecha"><b>Cupos</b>: {{ $dia["cupos_disponibles"] }} / {{ $dia["cupo_maximo"] }}   </span><br> 
                  </div>
                  
                @endforeach
            </div>
            @endforeach
            
        </div>
    </div>
              </div>
            </div>
            <div class="tab-content hiddenTab" id="tabTwo_data">
              <div class="flex flex-col gap-5">
                
                
                
                
                <div class="bg-white p-3 rounded-xl flex justify-start items-center gap-4 border border-color21 dark:bg-color9 dark:border-color7">
                  <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/images/library-favourite-img4.png" alt="" class="h-[100px] w-[140px] object-cover">
                    <p class="text-white bg-p1 absolute bottom-2 right-2 text-xs px-2 py-1 rounded-md">
                      10 Qs
                    </p>
                  </div>
                  <div class="">
                    <p class="font-semibold">Competitive Quizzes for..</p>
                    <p class="text-bgColor18 text-xs flex justify-start items-center gap-1 pt-3 pb-2 dark:text-color18">
                      Today
                      <i class="ph-fill ph-dot-outline text-p1 text-xl !leading-none"></i>
                      600 plays
                    </p>
                    <p class="text-xs text-color5 flex justify-start items-center gap-1 dark:text-color18">
                      <i class="ph ph-users-three text-base !leading-none"></i>
                      Public
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-content hiddenTab" id="tabThree_data">
              <div class="flex flex-col gap-5">
                
                
                
                
                <div class="bg-white p-3 rounded-xl flex justify-start items-center gap-4 border border-color21 dark:bg-color9 dark:border-color7">
                  <div class="relative rounded-lg overflow-hidden">
                    <img src="assets/images/library-favourite-img2.png" alt="" class="h-[100px] w-[140px] object-cover">
                    <p class="text-white bg-p1 absolute bottom-2 right-2 text-xs px-2 py-1 rounded-md">
                      10 Qs
                    </p>
                  </div>
                  <div class="">
                    <p class="font-semibold">Guess the Name of Riva..</p>
                    <p class="text-bgColor18 text-xs flex justify-start items-center gap-1 pt-3 pb-2 dark:text-color18">
                      Today
                      <i class="ph-fill ph-dot-outline text-p1 text-xl !leading-none"></i>
                      600 plays
                    </p>
                    <div class="text-xs text-color5 flex justify-start items-center gap-2 dark:text-color18">
                      <div class="flex justify-start items-center">
                        <div class="rounded-full bg-white p-0.5">
                          <img src="assets/images/user-img-1.png" alt="" class="size-6 object-cover rounded-full">
                        </div>
                        <div class="rounded-full bg-white p-0.5 -ml-2">
                          <img src="assets/images/user-img-2.png" alt="" class="size-6 object-cover rounded-full">
                        </div>
                        <div class="rounded-full bg-white p-0.5 -ml-2">
                          <img src="assets/images/user-img-3.png" alt="" class="size-6 object-cover rounded-full">
                        </div>
                        <div class="rounded-full bg-white p-0.5 -ml-2">
                          <img src="assets/images/user-img-4.png" alt="" class="size-6 object-cover rounded-full">
                        </div>
                        <div class="rounded-full bg-white p-0.5 -ml-2">
                          <img src="assets/images/user-img-5.png" alt="" class="size-6 object-cover rounded-full">
                        </div>
                      </div>
                      <p>Public</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        

        <!-- <div class="px-6">
          <div class="px-4 bg-p2 flex justify-between items-center rounded-2xl relative after:absolute after:h-full after:left-2 after:right-2 after:bg-p2 after:mt-6 after:opacity-30 after:rounded-2xl after:-z-10 before:absolute before:h-full before:bg-p2 before:mt-12 before:opacity-30 before:rounded-2xl before:-z-10 before:left-4 before:right-4">
            <div class="text-white font-semibold !leading-none pl-2">
              <p class="">Invite Friends</p>
              <p class="text-[36px] py-2 pl-2">$80</p>
              <p class="pl-7">Earn Up To</p>
            </div>
            <div class="">
              <img src="{{url('template/app/assets/images/invite_illus.png')}}" alt="">
            </div>
          </div>
        </div> -->

        <!-- <div class="pt-12 px-6">
          <div class="flex justify-between items-center">
            <div class="flex justify-start items-center gap-2">
              <i class="ph-fill text-xl ph-trophy text-p1"></i>
              <h3 class="text-xl font-semibold">Current Contest</h3>
            </div>
            <a href="upcoming-contest.html" class="text-p1 font-semibold text-sm">See All</a>
          </div>
          <div class="pt-5">
            <a href="quiz-details.html" class="rounded-2xl overflow-hidden shadow2 block">
              <div class="flex justify-between items-center py-3.5 px-5 bg-p2 bg-opacity-20 dark:bg-bgColor16">
                <div class="flex justify-start items-center gap-3">
                  <p class="font-medium">Starting In</p>
                  <div class="flex justify-start items-center gap-1">
                    <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                      05
                    </p>
                    <p class="text-p2 text-base font-semibold dark:text-white">
                      :
                    </p>
                    <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                      14
                    </p>
                    <p class="text-p2 text-base font-semibold dark:text-white">
                      :
                    </p>
                    <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                      20
                    </p>
                  </div>
                </div>
                <p class="text-xs text-p1">Read Instruction</p>
              </div>
              <div class="p-5 bg-white dark:bg-color10">
                <div class="flex justify-start items-center gap-2">
                  <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                    <p class="font-semibold text-xs">19 Jun</p>
                    <p class="text-[10px]">04.32</p>
                  </div>
                  <div class="">
                    <p class="font-semibold text-sm">Browse By Category</p>
                    <p class="text-xs">Language - English , Hindi</p>
                  </div>
                </div>
                <div class="flex justify-between items-center text-xs py-5 border-b border-dashed border-black border-opacity-10 dark:border-color24">
                  <div class="">
                    <p>Max Time</p>
                    <p class="font-semibold">5 min</p>
                  </div>
                  <div class="">
                    <p>Max Ques</p>
                    <p class="font-semibold">v</p>
                  </div>
                  <div class="">
                    <p>No of Contest</p>
                    <p class="font-semibold">1</p>
                  </div>
                </div>
                <div class="pt-5 flex justify-between items-center">
                  <div class="flex justify-start items-center gap-1">
                    <i class="ph ph-brain text-p2"></i>
                    <p class="text-xs">Trivia Quiz</p>
                  </div>
                  <div class="flex justify-start items-center gap-2">
                    <i class="ph ph-bell-ringing"></i>
                    <i class="ph ph-share-network"></i>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div> -->
        <!-- <div class="pt-12 pl-6">
          <div class="flex justify-between items-center pr-6">
            <div class="flex justify-start items-center gap-2">
              <i class="ph-fill text-xl ph-trophy text-p1"></i>
              <h3 class="text-xl font-semibold">Best Players</h3>
            </div>
            <a href="players.html" class="text-p1 font-semibold text-sm">See All</a>
          </div>
          <div class="pt-5 swiper best-player-slider">
            <div class="swiper-wrapper">
              <div class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                <div class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                  <div class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                    <i class="ph-fill ph-trophy text-p1"></i>
                    <p class="text-xs font-semibold text-p2 dark:text-white">
                      #1
                    </p>
                  </div>
                  <img src="{{url('template/app/assets/images/Flags1.png')}}" alt="">
                </div>
                <div class="flex flex-col justify-center items-center pt-4">
                  <div class="relative size-24 flex justify-center items-center">
                    <img src="{{url('template/app/assets/images/user-img-1.png')}}" alt="" class="size-[68px] rounded-full">
                    <img src="{{url('template/app/assets/images/user-progress.svg')}}" alt="" class="absolute top-0 left-0">
                    <img src="{{url('template/app/assets/images/medal1.svg')}}" alt="" class="absolute -bottom-1.5 left-9 size-7">
                  </div>
                  <a href="user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                    ShadowStriker
                  </a>
                  <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                    1060 XP
                  </p>
                  <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                    Follow
                  </button>
                </div>
              </div>
              <div class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                <div class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                  <div class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                    <i class="ph-fill ph-trophy text-p1"></i>
                    <p class="text-xs font-semibold text-p2 dark:text-white">
                      #2
                    </p>
                  </div>
                  <img src="{{url('template/app/assets/images/Flags2.png')}}" alt="">
                </div>
                <div class="flex flex-col justify-center items-center pt-4">
                  <div class="relative size-24 flex justify-center items-center">
                    <img src="{{url('template/app/assets/images/user-img-2.png')}}" alt="" class="size-[68px] rounded-full">
                    <img src="{{url('template/app/assets/images/user-progress.svg')}}" alt="" class="absolute top-0 left-0">
                    <img src="{{url('template/app/assets/images/medal2.svg')}}" alt="" class="absolute -bottom-1.5 left-9 size-7">
                  </div>
                  <a href="user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                    BlazeKnight
                  </a>
                  <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                    660 XP
                  </p>
                  <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                    Follow
                  </button>
                </div>
              </div>
              <div class="p-4 rounded-xl border border-black border-opacity-10 bg-white shadow2 swiper-slide dark:bg-color9 dark:border-color24">
                <div class="flex justify-between items-center pb-3 border-b border-dashed border-black border-opacity-10">
                  <div class="bg-p2 bg-opacity-10 border border-p2 border-opacity-20 py-1 px-3 flex justify-start items-center gap-1 rounded-full dark:bg-bgColor14 dark:border-bgColor16">
                    <i class="ph-fill ph-trophy text-p1"></i>
                    <p class="text-xs font-semibold text-p2 dark:text-white">
                      #3
                    </p>
                  </div>
                  <img src="{{url('template/app/assets/images/GB.png')}}" alt="">
                </div>
                <div class="flex flex-col justify-center items-center pt-4">
                  <div class="relative size-24 flex justify-center items-center">
                    <img src="{{url('template/app/assets/images/user-img-3.png')}}" alt="" class="size-[68px] rounded-full">
                    <img src="{{url('template/app/assets/images/user-progress.svg')}}" alt="" class="absolute top-0 left-0">
                    <img src="{{url('template/app/assets/images/medal3.svg')}}" alt="" class="absolute -bottom-1.5 left-9 size-7">
                  </div>
                  <a href="user-profile.html" class="text-xs font-semibold text-color8 dark:text-white pt-4">
                    ShadowStriker
                  </a>
                  <p class="text-color8 pt-1 pb-4 dark:text-white text-xs">
                    2060 XP
                  </p>
                  <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                    Follow
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <div class="pt-12 pl-6">
          <!-- <div class="flex justify-between items-center pr-6">
            <div class="flex justify-start items-center gap-2">
              <h3 class="text-xl font-semibold">Upcoming Contest</h3>
            </div>
            <a href="upcoming-contest.html" class="text-p1 font-semibold text-sm">See All</a>
          </div>
          <div class="pt-5 swiper upcoming-contest-slider">
            <div class="swiper-wrapper">
              <a href="quiz-details.html" class="rounded-2xl overflow-hidden shadow2 swiper-slide border border-color21">
                <div class="p-5 bg-white dark:bg-color10">
                  <div class="flex justify-between items-center">
                    <div class="flex justify-start items-center gap-2">
                      <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                        <p class="font-semibold text-xs">19 Jun</p>
                        <p class="text-[10px]">04.32</p>
                      </div>
                      <div class="">
                        <p class="font-semibold text-xs">
                          English Language Quiz
                        </p>
                        <p class="text-xs">Language - English</p>
                      </div>
                    </div>
                    <div class="flex justify-start items-center gap-1">
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        05
                      </p>
                      <p class="text-p2 text-base font-semibold dark:text-p1">
                        :
                      </p>
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        14
                      </p>
                      <p class="text-p2 text-base font-semibold dark:text-p1">
                        :
                      </p>
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        20
                      </p>
                    </div>
                  </div>
                  <div class="flex justify-between items-center text-xs pt-5">
                    <div class="flex gap-2">
                      <p>Max Time</p>
                      <p class="font-semibold">- 5 min</p>
                    </div>
                    <div class="flex gap-3">
                      <p>Max Ques</p>
                      <p class="font-semibold">- 20</p>
                    </div>
                  </div>
                  <div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap">
                    <p>30 left</p>
                    <div class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full after:absolute after:h-1 after:w-[40%] after:bg-p2 after:dark:bg-p1 after:rounded-full"></div>
                    <p>100 spots</p>
                  </div>
                  <div class="border-b border-dashed border-black dark:border-color24 border-opacity-10 pb-5 flex justify-between items-center text-xs">
                    <div class="flex justify-start items-center gap-2">
                      <div class="text-white flex justify-center items-center p-2 bg-p1 rounded-full">
                        <i class="ph ph-trophy"></i>
                      </div>
                      <div class="">
                        <p>Price Pool</p>
                        <p class="font-semibold">$100</p>
                      </div>
                    </div>
                    <div class="flex justify-start items-center gap-2">
                      <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                        Join Now
                      </button>
                      <div class="">
                        <p>Entry</p>
                        <p class="font-semibold">$2.00</p>
                      </div>
                    </div>
                  </div>
                  <div class="pt-5 flex justify-between items-center">
                    <div class="flex justify-start items-center gap-1">
                      <i class="ph ph-brain text-p2"></i>
                      <p class="text-xs">Trivia Quiz</p>
                    </div>
                    <div class="flex justify-start items-center gap-2">
                      <i class="ph ph-bell-ringing"></i>
                      <i class="ph ph-share-network"></i>
                    </div>
                  </div>
                </div>
              </a>
              <a href="quiz-details.html" class="rounded-2xl overflow-hidden shadow2 swiper-slide border border-color21">
                <div class="p-5 bg-white dark:bg-color10">
                  <div class="flex justify-between items-center">
                    <div class="flex justify-start items-center gap-2">
                      <div class="py-1 px-2 text-white bg-p2 rounded-lg dark:bg-p1 dark:text-black">
                        <p class="font-semibold text-xs">20 Jun</p>
                        <p class="text-[10px]">05.25</p>
                      </div>
                      <div class="">
                        <p class="font-semibold text-xs">China Language Quiz</p>
                        <p class="text-xs">Language - English</p>
                      </div>
                    </div>
                    <div class="flex justify-start items-center gap-1">
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        03
                      </p>
                      <p class="text-p2 text-base font-semibold dark:text-p1">
                        :
                      </p>
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        12
                      </p>
                      <p class="text-p2 text-base font-semibold dark:text-p1">
                        :
                      </p>
                      <p class="text-p2 text-[10px] py-0.5 px-1 bg-p2 bg-opacity-20 dark:text-p1 dark:bg-color24 rounded-md">
                        16
                      </p>
                    </div>
                  </div>
                  <div class="flex justify-between items-center text-xs pt-5">
                    <div class="flex gap-2">
                      <p>Max Time</p>
                      <p class="font-semibold">- 5 min</p>
                    </div>
                    <div class="flex gap-3">
                      <p>Max Ques</p>
                      <p class="font-semibold">- 20</p>
                    </div>
                  </div>
                  <div class="flex justify-between items-center gap-2 text-xs py-3 text-nowrap">
                    <p>45 left</p>
                    <div class="relative bg-p2 dark:bg-p1 dark:bg-opacity-10 bg-opacity-10 h-1 w-full rounded-full after:absolute after:h-1 after:w-[20%] after:bg-p2 after:dark:bg-p1 after:rounded-full"></div>
                    <p>100 spots</p>
                  </div>
                  <div class="border-b border-dashed border-black dark:border-color24 border-opacity-10 pb-5 flex justify-between items-center text-xs">
                    <div class="flex justify-start items-center gap-2">
                      <div class="text-white flex justify-center items-center p-2 bg-p1 rounded-full">
                        <i class="ph ph-trophy"></i>
                      </div>
                      <div class="">
                        <p>Price Pool</p>
                        <p class="font-semibold">$100</p>
                      </div>
                    </div>
                    <div class="flex justify-start items-center gap-2">
                      <button class="text-white text-xs bg-p2 py-1 px-4 rounded-full dark:bg-p1">
                        Join Now
                      </button>
                      <div class="">
                        <p>Entry</p>
                        <p class="font-semibold">$5.00</p>
                      </div>
                    </div>
                  </div>
                  <div class="pt-5 flex justify-between items-center">
                    <div class="flex justify-start items-center gap-1">
                      <i class="ph ph-brain text-p2"></i>
                      <p class="text-xs">Language Quiz</p>
                    </div>
                    <div class="flex justify-start items-center gap-2">
                      <i class="ph ph-bell-ringing"></i>
                      <i class="ph ph-share-network"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div> -->
        </div>
      </div>
    </div>

    <!-- Bottom Tab Start -->
    @include("app.layouts.menu-footer")
    <!-- Bottom Tab End -->

    <!-- Sidebar Start -->
    @include("app.layouts.sidebar")
@endsection

@push('page_scripts')
<script>
  let urlBase = "/app/clases";
  let urlParams = new URLSearchParams(window.location.search);
  let fechaInicio = urlParams.get("fecha_inicio") ? new Date(urlParams.get("fecha_inicio")) : new Date();

  function formatDate(date) {
    return date.toISOString().split("T")[0]; // Formato YYYY-MM-DD
  }

  function updateWeekDisplay() {
    let startOfWeek = new Date(fechaInicio);
    startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay() + 1); // Lunes
    let endOfWeek = new Date(startOfWeek);
    endOfWeek.setDate(endOfWeek.getDate() + 6); // Domingo
    
    fechaInicio = startOfWeek;

    document.getElementById("weekRange").innerText = `Del ${formatDate(startOfWeek)} al ${formatDate(endOfWeek)}`;
  }

  function changeWeek(direction) {
    fechaInicio.setDate(fechaInicio.getDate() + 7 * direction);
    let fechaFin = new Date(fechaInicio);
    fechaFin.setDate(fechaInicio.getDate() + 6); // Domingo de la nueva semana

    let newUrl = `${urlBase}?fecha_inicio=${formatDate(fechaInicio)}&fecha_fin=${formatDate(fechaFin)}`;
    window.location.href = newUrl;
  }

  document.getElementById("btnPrev").addEventListener("click", () => changeWeek(-1)); // Semana anterior
  document.getElementById("btnNext").addEventListener("click", () => changeWeek(1));  // Semana siguiente

  updateWeekDisplay(); // Muestra la semana actual al cargar la página
</script>
@endpush