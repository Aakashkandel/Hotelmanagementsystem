<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EsewaController extends Controller
{
    /**
     * Redirect to eSewa for payment initiation.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function index()
    {

        return view('user.esewaform');
    }
    public function esewa($id)
    {
        $booking = Booking::find($id);

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

        return view('user.esewaform', compact('product_code', 'amount', 'tax_amount', 'total_amount', 'success_url', 'failure_url', 'transaction_uuid', 'signed_field_names', 'signature'));
    }

    function esewaSuccess(Request $request)
    { 
        $transaction_code = $request->input('transaction_code');
        $transaction_uuid = $request->input('transaction_uuid');
        $total_amount = $request->input('total_amount');
        $status = $request->input('status');
        $secret_key = '8gBm/:&EnhH.1/q';
        $product_code = 'EPAYTEST';

        $data = "transaction_code={$transaction_code},status={$status},total_amount={$total_amount},transaction_uuid={$transaction_uuid}";
        $hash = base64_encode(hash_hmac('sha256', $data, $secret_key, true));


        if ($hash !== $request->input('signature')) {
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        list($extracted_id, $extracted_timestamp) = explode('-', $transaction_uuid);


die( "Booking ID: " . $extracted_id . "\n");
echo "Timestamp: " . $extracted_timestamp . "\n";


        $booking = Booking::where('id', $extracted_id)->first();
        if (!$booking) {
            return redirect()->route('esewa.fail')->with('error', 'Booking not found');
        }
        $redirectUrl = "https://rc-epay.esewa.com.np/api/epay/transaction/status/?product_code={$product_code}&total_amount={$total_amount}&transaction_uuid={$extracted_id}";
        header("Location: $redirectUrl", true, 302);
        exit;
    }


    /**
     * Verify eSewa payment status.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function esewaFail(Request $request)
    {
        return redirect()->route('user.index')->with('error', 'Payment failed');
    }
}
