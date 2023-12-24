<?php

// app/Http/Controllers/RazorpayController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Http;


class RazorpayController extends Controller
{

    public function initiatePayment(Request $request)
    {
        $api = new Api(config('razorpay.key_id'), config('razorpay.key_secret'));

        $order = $api->order->create([
            'receipt' => 'order_receipt_' . time(),
            'amount' => 599 * 100, // Amount in paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        $orderId = $order->id;

        return view('razorpay.payment', compact('orderId'));
    }

    public function handlePaymentCallback(Request $request)
    {
        // return redirect('/results')->with('success', 'Payment successful!');


        // Handle payment success callback
        // Update your database, mark the payment as successful, etc.
        // Make API request
        $apiEndpoint = 'http://localhost:8000/superadmin/update-credits';

        // Assuming you have the user ID and credit amount from your payment handling logic
        $userId = intval($request->input("userid")); // Replace with the actual user ID
        $creditAmount = 10; // Replace with the actual credit amount

        try {
            $response = Http::post($apiEndpoint, [
                'userid' => $userId,
                'credit' => $creditAmount,
            ]);

            // Check the response status
            if ($response->successful()) {
                // API request was successful
                return redirect('/results')->with('success', 'Payment successful! API request sent.');
            } else {
                // API request failed
                return redirect('/results')->with('error', 'Payment successful, but API request failed.');
            }
        } catch (\Exception $e) {
            // Exception occurred during the API request
            return redirect('/results')->with('error', 'Payment successful, but API request failed: ' . $e->getMessage());
        }
    }
}
