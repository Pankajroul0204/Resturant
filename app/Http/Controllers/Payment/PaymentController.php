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


    public function order($id)
    {
        $data=TableBooking::find($id)->first();
        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => 'Booking Fee',
                        'description' => 'Booking payment for id "' . $data->booking_id . '"'
                    ],
                    'unit_amount' => 100 * 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);
        return redirect($checkout_session->url);
    }
    public function orderdetails()
    {
        $response = $this->stripe->checkout->sessions->retrieve('cs_test_a1pb50MvhrSBAISad1qNh51B8Ahuv66KYXhRflgANMkWucyc1rwrWhvSkm');
        dd($response);
    }
}
