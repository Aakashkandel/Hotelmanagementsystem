@extends('layouts.app')
@section('content')
<div class="flex flex-col w-full">
    <div class="flex items-center justify-between w-full">
        <h2 class="text-lg font-semibold text-gray-700">Room</h2>
        <div class="flex items-center space-x-2">
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500">
                <i class="bx bx-search"></i>
            </button>
            <button class="flex items-center justify-center h-8 w-8 rounded-full bg-gray-200 text-gray-500">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
        </div>
    </div>

    <div class="mt-10 text-right">
        <a href="{{route('room.create')}}" class="bg-blue-600 text-white p-3 rounded-lg">Add Product</a>
    </div>

    <div class="mt-2">
       
        <div class="mt-4">
            <div class="overflow-x-auto bg-white rounded-lg shadow-xs">
                <table class="w-full whitespace-nowrap">
                    <thead>
                        <tr class="font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b">
                            <th class="px-4 py-3">S.N</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">RoomId</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Capacity</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php $sn=0; ?>
                        @foreach($rooms as $room)
                        <?php $sn++ ?>
                        <tr class="text-gray-700">
                        <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold"><?php echo $sn ?></p>
                                        
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{$room->name}}</p>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <img class="object-cover w-8 h-8 rounded-full" src="{{asset('images/rooms/'.$room->photo)}}" alt="User Avatar">
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{$room->room_id}}</p>
                                       
                                    </div>
                                </div>
                            </td>


                           
                            <td class="px-4 py-3 text-sm border">
                               {{$room->price}}
                            </td>
                            <td class="px-4 py-3 text-xs border">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                   {{$room->status}}
                                </span>
                            </td>
                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div>
                                        <p class="font-semibold">{{$room->capacity}}</p>
                                       
                                    </div>
                                </div>
                            </td>

                            <td class="px-4 py-3 border">
                                <div class="flex items-center text-sm">
                                    <div class="overflow-hidden">
                                        <p class="font-semibold p-1 w-40">{{$room->description}}</p>
                                      
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm border">
                               {{$room->created_at}}
                            </td>

                            <td class="border p-3">
                        <a href="{{route('room.edit',$room->id)}}" class="bg-blue-500 text-white p-2 rounded-lg">Edit</a>
                        <a href="{{route('room.delete',$room->id)}}" class="bg-red-500 text-white p-2 rounded-lg" onclick="return confirm('Are you sure to Delete?')">Delete</a>
                    </td>
                        </tr>

                        @endforeach
                        <!-- Repeat similar rows for more bookings -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection