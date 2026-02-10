@extends("app.layouts.app")
@section("content")
<div class="relative z-10 pb-20">
    <div class="relative z-10 px-6">
        <div class="text-center font-bold text-xl mb-6">Training Routines</div>
        
        <!-- Routine Selection -->
        <div class="space-y-6">
            <a href="{{ url('app/routine/strength') }}" class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-lg">
                <div>
                    <div class="text-lg font-bold">Strength Training</div>
                    <p class="text-gray-600">Focus on building muscle and strength.</p>
                </div>
                <i class="ph ph-arrow-right text-gray-500 text-2xl"></i>
            </a>
            <a href="{{ url('app/routine/cardio') }}" class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-lg">
                <div>
                    <div class="text-lg font-bold">Cardio Training</div>
                    <p class="text-gray-600">Improve endurance and burn calories.</p>
                </div>
                <i class="ph ph-arrow-right text-gray-500 text-2xl"></i>
            </a>
            <a href="{{ url('app/routine/flexibility') }}" class="flex justify-between items-center bg-white p-6 rounded-2xl shadow-lg">
                <div>
                    <div class="text-lg font-bold">Flexibility Training</div>
                    <p class="text-gray-600">Enhance mobility and prevent injuries.</p>
                </div>
                <i class="ph ph-arrow-right text-gray-500 text-2xl"></i>
            </a>
        </div>
    </div>
</div>
@include("app.layouts.menu-footer")
@include("app.layouts.sidebar")
@endsection
@push("page_scripts")
<script src="https://cdn.tailwindcss.com"></script>
@endpush
