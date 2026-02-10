@extends("app.layouts.app")
@section("content")
 <!-- Page Title Start -->
  
 <div class="relative z-10 pb-20">
        <div class="flex justify-between items-center gap-4 px-6 relative z-20">
          <div class="flex justify-start items-center gap-2">
            <button class="sidebarModalOpenButton text-2xl text-white !leading-none">
              <i class="ph ph-list"></i>
            </button>
            <h1 class="text-2xl font-semibold text-white title">Fitness Club</h1>
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
        <div class="flex justify-between items-center gap-3 pt-8 px-6 relative z-20">
          <a href="contest-search-result.html" class="flex justify-start items-center gap-3 bg-color24 border border-color24 p-4 rounded-full text-white w-full">
            <i class="ph ph-magnifying-glass"></i>
            <span class="text-white w-full text-xs">
              <span>Search Contest</span>
            </span>
          </a>
          <div class="bg-color24 border border-color24 p-4 rounded-full text-white flex justify-center items-center">
            <i class="ph ph-sliders-horizontal"></i>
          </div>
        </div>
        <!-- Search Box End -->
        <div class="relative">
          <p class="text-white text-center pt-5 text-sm font-semibold">
             <br><br><br><br><br><br><br>
          </p>
          
         
        </div>

        

        <div class="px-6">
          <div class="">
          <div class="grid grid-cols-2 gap-5">
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon1.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Clases</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1">  </p>
                  </div>
                </div>
                <div class="flex justify-start items-start gap-2 bg-white px-3 pt-3 pb-6 rounded-xl dark:bg-color9">
                  <img src="{{url('template/app/assets/images/icon2.png')}}" alt="" class="size-12">
                  <div class="">
                    <p class="text-sm font-semibold">Perfil</p>
                    <p class="text-xs text-p2 pt-1 dark:text-p1"></p>
                  </div>
                </div>
                
              </div>
          </div>
        </div> 

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