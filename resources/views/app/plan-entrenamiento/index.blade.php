@extends("app.layouts.app")
@section("content")
<div class="relative z-10 pb-20">

    <!-- Page Title Start -->
    <div class="relative z-10 px-6">
        <div class="text-center font-bold text-xl mb-6">Choose Your Training Plan</div>

        <!-- Routine Selection Tabs -->
        <div class="flex justify-center gap-4 mb-6">
            <button class="bg-red-500 text-white px-4 py-2 rounded-lg focus:outline-none">Strength</button>
            <button class="bg-gray-300 text-black px-4 py-2 rounded-lg focus:outline-none">Cardio</button>
            <button class="bg-gray-300 text-black px-4 py-2 rounded-lg focus:outline-none">Flexibility</button>
            <button class="bg-gray-300 text-black px-4 py-2 rounded-lg focus:outline-none">HIIT</button>
        </div>

        <!-- Training Plans -->
        <div class="space-y-6">
            <!-- Strength Training -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="text-lg font-bold mb-4">Strength Training</div>
                <div class="space-y-4">
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/2875/2875422.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Weight Lifting<br><span class="font-bold text-black">40 min - Full Body</span></div>
                    </div>
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/1041/1041921.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Deadlifts<br><span class="font-bold text-black">30 min - Strength</span></div>
                    </div>
                </div>
            </div>

            <!-- Cardio Training -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="text-lg font-bold mb-4">Cardio Training</div>
                <div class="space-y-4">
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/2964/2964514.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Running<br><span class="font-bold text-black">30 min - Endurance</span></div>
                    </div>
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/868/868745.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Cycling<br><span class="font-bold text-black">25 min - Cardio</span></div>
                    </div>
                </div>
            </div>

            <!-- Flexibility Training -->
            <div class="bg-white p-6 rounded-2xl shadow-lg">
                <div class="text-lg font-bold mb-4">Flexibility Training</div>
                <div class="space-y-4">
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/1046/1046784.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Stretching<br><span class="font-bold text-black">15 min - Mobility</span></div>
                    </div>
                    <div class="flex items-center bg-gray-200 p-3 rounded-lg">
                        <img src="https://cdn-icons-png.flaticon.com/512/3208/3208670.png" class="w-12 h-12">
                        <div class="ml-3 text-gray-600">Yoga<br><span class="font-bold text-black">20 min - Relaxation</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include("app.layouts.menu-footer")
@include("app.layouts.sidebar")
@endsection
@push("page_scripts")
<script src="https://cdn.tailwindcss.com"></script>
@endpush
