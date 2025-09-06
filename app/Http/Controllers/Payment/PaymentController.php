<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        dd($this->stripe);
    }

    public function order(Request $req)
    {
       $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => [[
              'price_data' => [
                'currency' => 'inr',
                'product_data' => [
                  'name' => 'Pant',
                ],
                'unit_amount' =>100 * 599,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
          ]);
        //   dd($checkout_session);
          return redirect($checkout_session->url);
    }
    public function orderdetails()
    {
        $response = $this->stripe->checkout->sessions->retrieve('cs_test_a1pb50MvhrSBAISad1qNh51B8Ahuv66KYXhRflgANMkWucyc1rwrWhvSkm');
        dd($response);
    }
}
