<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\TableBooking;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    public $stripe;
    function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('STRIPE_SK')
        );
    }


    public function order($data = null)
    {
        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => 'Booking Fee For ' . $data->booking_id . '',
                        // 'name' => 'Booking Fee For',
                    ],
                    'unit_amount' => 100 * 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel')
        ]);
        return ['url' => $checkout_session->url, 'session_id' => $checkout_session->id];
    }
    public function orderdetails()
    {
        $response = $this->stripe->checkout->sessions->retrieve('cs_test_a1pb50MvhrSBAISad1qNh51B8Ahuv66KYXhRflgANMkWucyc1rwrWhvSkm');
        dd($response);
    }

    public function success(Request $request)
    {
        $sessionId = $request->get('session_id');
        $booking = TableBooking::where('session_id', $sessionId)->first();
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);
        if ($session->payment_status === 'paid') {
            $booking->payment_status = 'paid';
            $booking->status = 'confirmed';
            $booking->save();
            return view('payment_success', ['data' => 'For Booking ID : ' . $booking->booking_id . '']);
        }
    }

    public function cancel()
    {
        return view('payment_cancel');
    }
}
