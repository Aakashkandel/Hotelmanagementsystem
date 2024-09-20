<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
    public function index()
    {
        return view('user.esewaform');
    }

    public function esewa($id)
    {
        
    }

    public function esewaSuccess(Request $request)
    {
        $data = $request->input('data');
        $decoded_data = json_decode(base64_decode($data), true);

        if (!$decoded_data) {
            return response()->json(['error' => 'Invalid data'], 400);
        }

        $transaction_code = $decoded_data['transaction_code'];
        $transaction_uuid = $decoded_data['transaction_uuid'];
        $total_amount = $decoded_data['total_amount'];
        $status = $decoded_data['status'];
        $product_code = $decoded_data['product_code'];
        $signed_field_names = $decoded_data['signed_field_names'];
        $signature = $decoded_data['signature'];

        $secret_key = '8gBm/:&EnhH.1/q';
        $data_string = "transaction_code={$transaction_code},status={$status},total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code},signed_field_names={$signed_field_names}";
        $hash = base64_encode(hash_hmac('sha256', $data_string, $secret_key, true));

        if ($hash !== $signature) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        list($extracted_id, $extracted_timestamp) = explode('-', $transaction_uuid);

        $booking = Booking::where('id', $extracted_id)->first();
        if (!$booking) {
            return redirect()->route('esewa.fail')->with('error', 'Booking not found');
        }

        if ($status !== 'COMPLETE') {
            return redirect()->route('esewa.fail')->with('error', 'Payment not completed');
        }

        $booking=Booking::find($extracted_id);
        $booking->status='paid';
        $booking->save();

        $paymentdata = [
            'booking_id' => $extracted_id,
            'transaction_id' => $transaction_code,
            'amount' => $total_amount,
            'status' => $status,
            'payment_method' => 'esewa',
            'payment_status' => 'success',
            // 'payment_response' => json_encode($decoded_data) ,
        ];

         Payment::create($paymentdata);
        return redirect()->route('user.index')->with('success', 'Payment successful');


    }

    public function esewaFail(Request $request)
    {
        return redirect()->route('user.index')->with('error', 'Payment failed');
    }
}
?>