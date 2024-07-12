<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('created_at', 'desc')->get();
        return view('room.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        
        return view('room.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
           'room_id' => 'required|integer|min:1',
            'description'=>'required',
            'price'=>'required|integer||min:0',
            'capacity'=>'required|integer||min:1',
            'photo'=>'required|image',
            'status'=>'required',




        ]);

        $pathname=time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images/rooms'),$pathname);
        $data['photo']=$pathname;
        Room::create($data);
        return redirect()->route('room.index')->with('success','Room Added Successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { $room=Room::find($id);
        return view('room.edit',compact('room'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->validate([
            'name'=>'required',
           'room_id' => 'required|integer|min:1',
            'description'=>'required',
            'price'=>'required|integer||min:0',
            'capacity'=>'required|integer||min:1',
            'photo'=>'image',
            'status'=>'required',




        ]);
        $room=Room::find($id);
        $data['photo']=$room->photo;

        if($request->hasFile('photo'))
        {

       
        $pathname=time().'.'.$request->photo->extension();
        $request->photo->move(public_path('images/rooms'),$pathname);
        File::delete(public_path('images/rooms'.$room->photo));
        $data['photo']=$pathname;
        }

      $room->update($data);
        return redirect()->route('room.index')->with('success','Room updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room=Room::find($id);
        File::delete(public_path('images/rooms/'.$room->photo));
        $room->delete();
        return redirect()->route('room.index')->with('success','Room Deleted Successfully');

    }
}
