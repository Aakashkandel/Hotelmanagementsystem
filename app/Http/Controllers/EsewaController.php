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