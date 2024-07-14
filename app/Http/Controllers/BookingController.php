<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|min:10',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'guests' => 'required|integer',
            'room_type' => 'required|string|max:50',
            'message' => 'nullable|string',
            'payment_method' => 'nullable|string|max:50',
        ]);
    
        // If payment method is not provided, default to 'esewa'
        if (!isset($data['payment_method'])) {
            $data['payment_method'] = 'esewa';
        }
    
        try {
            // Create the booking
            $booking = Booking::create($data);
    
           
    
                // Redirect to eSewa payment route with booking ID
                return redirect()->route('esewa', $booking->id);
            
    
            // Handle booking creation failure if needed
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Booking Error: ' . $e->getMessage());
    
            // Redirect back with error message
            return redirect()->back()->with('error', 'Booking failed. Please try again.');
        }
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
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
