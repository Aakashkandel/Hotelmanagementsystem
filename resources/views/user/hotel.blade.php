
@extends('layouts.usernav')
@section('content')
<div class="flex flex-col w-full p-4 ">
    <div class="flex items-center justify-between w-full mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Rooms</h2>
        <div class="flex items-center space-x-2">
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500 hover:bg-gray-300">
                <i class="bx bx-search"></i>
            </button>
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500 hover:bg-gray-300">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
        </div>
    </div>
    <div>
        <div class="flex items-center space-x-2">
            <button class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-300">All</button>
            <button class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-300">Available</button>
        </div>
        
    </div>
    
    <div class="flex flex-wrap -mx-4">
    @foreach($rooms as $room)
        <div class="w-full md:w-1/2 lg:w-1/4 p-4">
            <div class="rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 bg-gray-300 overflow-hidden">
                <img src="{{ asset('images/rooms/' . $room->photo) }}" alt="" class="w-full h-48 object-cover rounded-t-lg">
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $room->name }}</h3>
                    <div class="flex items-center mt-2 mb-4">
                        <div class="flex items-center text-yellow-500">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.568L24 9.423l-5.833 6.012 1.357 8.062L12 18.747l-7.524 4.75 1.357-8.062L0 9.423l8.332-1.268L12 .587z"/>
                                </svg>
                            @endfor
                        </div>
                    </div>
                    <p class="text-sm text-gray-700 mb-2">{{ $room->description }}</p>
                    <p class="text-sm text-gray-700 mb-1"><strong>Price:</strong> Rs {{ $room->price }}</p>
                    <p class="text-sm text-gray-700 mb-1"><strong>Capacity:</strong> {{ $room->capacity }} people</p>
                    <p class="text-sm text-gray-700 mb-4"><strong>Status:</strong> {{ $room->status }}</p>
                    <div class="mt-4">
                        <a href="{{route('user.view',$room->id)}}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-300">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
