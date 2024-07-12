@extends('layouts.app')

@section('content')
<div class="flex flex-col w-full max-w-3xl mx-auto mt-10">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Add New Room</h2>
        @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-500">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Room Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}" required>
            </div>
            <div class="mb-4">
                <label for="room_id" class="block text-sm font-medium text-gray-600">Room Number</label>
                <input type="number" name="room_id" id="room_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('room_number') }}" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600">Price per Night</label>
                <input type="number" name="price" id="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('price') }}" required>
            </div>
            <div class="mb-4">
                <label for="capacity" class="block text-sm font-medium text-gray-600">Capacity</label>
                <input type="number" name="capacity" id="capacity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('capacity') }}" required>
            </div>
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-600">Photo</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div class="flex justify-end">
                <a href="{{route('room.index')}}"  class="px-4 py-2 bg-gray-300 mx-2 text-black rounded-lg shadow-md">Back</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 mx-2 text-white rounded-lg shadow-md">Add Room</button>
            </div>
        </form>
    </div>
</div>
@endsection

