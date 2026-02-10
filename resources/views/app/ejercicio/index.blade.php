@extends("app.layouts.app")
@section("content")
<div class="relative z-10 pb-20">
    <div class="relative z-10 px-6">
        <div class="text-center font-bold text-xl mb-6">Exercise Details</div>
        
        <div class="bg-white p-6 rounded-2xl shadow-lg">
            <div class="text-lg font-bold">Push-Ups</div>
            <img src="https://images.pexels.com/photos/416717/pexels-photo-416717.jpeg" alt="Push-Ups" class="w-full h-64 object-cover rounded-lg mt-4">
            <p class="text-gray-600 mt-4">Push-ups are a basic exercise used in athletic training or physical education and commonly in military physical training.</p>
            
            <div class="mt-6">
                <p><span class="font-bold">Sets:</span> 3</p>
                <p><span class="font-bold">Reps:</span> 15</p>
                <p><span class="font-bold">Rest Time:</span> 30 seconds</p>
            </div>
            
            <div class="mt-6">
                <a href="{{ url('app/routine/strength') }}" class="block text-center bg-red-500 text-white py-2 rounded-lg">Back to Routine</a>
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
