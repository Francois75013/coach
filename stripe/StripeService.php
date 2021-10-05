<?php

namespace App\stripe;

use App\Entity\Coachs;
use App\Entity\Reservation;
use App\Entity\Disponibilite;


use App\stripe\checkout_session;


Class StripeService{

    private $privateKey;

    public function __construct()
    {
        $_ENV['APP_ENV'] === 'dev';
        $this->privateKey = $_ENV['STRIPE_SECRET_KEY_LIVE'];
        
    }

    public function paymentIntent(Coachs $coachs, Reservation $reservation)
    {
        stripe\StripeService::SetApiKey($this->privateKey);

        return stripe\StripeService\PaymentIntent::create([
            'amount' => $coachs->getPrix() = 100,
            'currency' => Reservation::DEVISE,
            'payment_method_type'=>('card'),
        ]); 
    }

}
