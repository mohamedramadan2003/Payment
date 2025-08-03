<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\StripeClient;
use Illuminate\Http\Request;

class PayController extends Controller
{
    private $stripe ;
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.api_key.api_secret'));
    }
    public function pay()
    {
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',
            'success_url' => 'https://www.google.com',
            'cancel_url' => 'https://example.com/cancel',
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'T-Shirt'
                        ],
                        'unit_amount' => 2000,
                    ],
                    'quantity' => 2
                ]
            ]
        ]);

        return redirect($session->url);
    }
}
