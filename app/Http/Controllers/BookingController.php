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
            'user_id' => 'string',
            'phone' => 'required|numeric|min:10',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'guests' => 'required|integer',
            'status' => 'string',
            'room_type' => 'required|string|max:50',
            'message' => 'nullable|string',
            'payment_method' => 'nullable|string|max:50',
        ]);

        $data['status'] = 'pending';
        $data['user_id'] = auth()->user()->id;

        // If payment method is not provided, default to 'esewa'
        if (!isset($data['payment_method'])) {
            $data['payment_method'] = 'esewa';
        }



        try {
            // Create the booking
            $booking = Booking::create($data);

          
            $booking = Booking::find($booking->id);

            if (!$booking) {
                return redirect()->back()->with('error', 'Booking not found');
            }
    
            $product_code = 'EPAYTEST';
            $amount = 100;
            $tax_amount = 10;
            $total_amount = $amount + $tax_amount;
            $success_url = route('esewa.success');
            $failure_url = route('esewa.fail');
            $transaction_uuid = $booking->id.'-'.time();
            $signed_field_names = 'total_amount,transaction_uuid,product_code';
            $secret_key = '8gBm/:&EnhH.1/q';
    
            $data = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
            $signature = base64_encode(hash_hmac('sha256', $data, $secret_key, true));
    
            return response()->json([
                'product_code' => $product_code,
                'amount' => $amount,
                'tax_amount' => $tax_amount,
                'total_amount' => $total_amount,
                'success_url' => $success_url,
                'failure_url' => $failure_url,
                'transaction_uuid' => $transaction_uuid,
                'signed_field_names' => $signed_field_names,
                'signature' => $signature,
            ])->withHeaders([
                'Content-Type' => 'text/html'
            ])->setStatusCode(200)->setContent(
                '<html><body>' .
                '<form id="esewaForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">' .
                '<input type="hidden" name="amount" value="' . $amount . '">' .
                '<input type="hidden" name="tax_amount" value="' . $tax_amount . '">' .
                '<input type="hidden" name="total_amount" value="' . $total_amount . '">' .
                '<input type="hidden" name="transaction_uuid" value="' . $transaction_uuid . '">' .
                '<input type="hidden" name="product_code" value="' . $product_code . '">' .
                '<input type="hidden" name="product_service_charge" value="0">' .
                '<input type="hidden" name="product_delivery_charge" value="0">' .
                '<input type="hidden" name="success_url" value="' . $success_url . '">' .
                '<input type="hidden" name="failure_url" value="' . $failure_url . '">' .
                '<input type="hidden" name="signed_field_names" value="' . $signed_field_names . '">' .
                '<input type="hidden" name="signature" value="' . $signature . '">' .
                '</form>' .
                '<script>document.getElementById("esewaForm").submit();</script>' .
                '</body></html>'
            );
            // return redirect()->route('esewa', $booking->id);


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
