<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $rooms = Room::orderby('id', 'desc')->paginate(3);
        return view('user.index',compact('rooms'));
    }
    public function welcome()
    {
        $rooms = Room::orderby('id', 'desc')->paginate(3);
        return view('welcome',compact('rooms'));
    }
    public function hotel()
    {
        $rooms = Room::all();
        return view('user.hotel',compact('rooms'));
    }

    public function view($id)
    {
        $room = Room::find($id);
        return view('user.view',compact('room'));
    }

    public function admin()
    {
        return view('dashboard');
    }
}
