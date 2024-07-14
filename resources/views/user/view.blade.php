@extends('layouts.usernav')
@section('content')
<div class="flex flex-col w-full p-4 ">
    <div class="flex items-center justify-between w-full mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Room Booking</h2>
        <div class="flex items-center space-x-2">
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500 hover:bg-gray-300">
                <i class="bx bx-search"></i>
            </button>
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500 hover:bg-gray-300">
                <i class="bx bx-dots
                -vertical-rounded"></i>
            </button>
        </div>
    </div>
    <div>
        <div class="flex items
        -center space-x-2">
            <button class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-300">All</button>
            <button class="bg-gray-200 text-gray-500 px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-300">Available</button>
        </div>

    </div>

    <div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Booking Form -->
            <?php
            $today = date('Y-m-d');
            ?>
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Book Your Room</h2>
                <form action="{{route('booking.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="room_id" value="{{$room->id}}">
                    <div class="mb-4">

                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" value="{{old('name')}}" id="name" name="name" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" id="phone" value="{{old('phone')}}" name="phone" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('phone')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" value="{{old('email')}}" name="email" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="checkin" class="block text-sm font-medium text-gray-700">Check-in Date</label>
                        <input type="date" value=<?php echo $today ?> id="checkin" name="checkin" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                        @error('checkin')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="checkout" class="block text-sm font-medium text-gray-700">Check-out Date</label>
                        <input type="date" id="checkout" value="{{old('checkout')}}" name="checkout" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('checkout')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="guests" class="block text-sm font-medium text-gray-700">Number of Guests</label>

                        <select id="guests" name="guests" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @for ($i = 1; $i <= $room->capacity; $i++)
                                <option value="{{ $i }}" @if(old('guests', '' )==$i) selected @endif>{{ $i }}</option>
                                @endfor
                        </select>
                        @error('guests')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="room" class="block text-sm font-medium text-gray-700">Room Type</label>
                        <select id="room" name="room_type" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="single" @if(old('room_type', '' )=='single' ) selected @endif>Single</option>
                            <option value="double" @if(old('room_type', '' )=='double' ) selected @endif>Double</option>
                            <option value="suite" @if(old('room_type', '' )=='suite' ) selected @endif>Suite</option>
                        </select>
                        @error('room_type')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea id="message" name="message" rows="4" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"> {{old('message')}}</textarea>
                        @error('message')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <label for="payment" class="block text-sm font-medium text-gray-700">Payment Method</label>
                        <select id="payment" name="payment_method" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="esewa">Esewa</option>
                        </select>
                        <img src="{{ asset('images/image/esewa.png') }}" alt="Payment Methods" class="mt-1 p-2 block w-3/12">
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors duration-300">Book Now</button>
                    </div>
                </form>
            </div>
            <!-- Hotel Details -->
            <div class="p-6 bg-gray-100 rounded-lg">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Room Details</h2>
                <div class="mb-4">
                    <img src="{{ asset('images/rooms/' . $room->photo) }}" alt="Room" class="w-full h-48 object-cover rounded-lg">
                </div>
                <p class="text-sm text-gray-700 mb-2">Room Name: {{ $room->name }}</p>
                <p class="text-sm text-gray-700 mb-2">Room ID: {{ $room->room_id }}</p>
                <p class="text-sm text-gray-700 mb-2">Description: {{ $room->description }}</p>
                <p class="text-sm text-gray-700 mb-2">Price: Rs {{ $room->price }}</p>
                <p class="text-sm text-gray-700 mb-2">Capacity: {{ $room->capacity }} people</p>
                <p class="text-sm text-gray-700 mb-2">Status: {{ $room->status }}</p>
                <div class="flex items-center mt-4">
                    <div class="flex items-center text-yellow-500">
                        @for ($i = 0; $i < 5; $i++) <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M12 .587l3.668 7.568L24 9.423l-5.833 6.012 1.357 8.062L12 18.747l-7.524 4.75 1.357-8.062L0 9.423l8.332-1.268L12 .587z" />
                            </svg>
                            @endfor
                    </div>



                </div>
            </div>
        </div>

    </div>
    @endsection