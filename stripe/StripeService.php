<?php

namespace App\stripe;

use App\Entity\Coachs;
use App\Entity\Reservation;
use App\Entity\Disponibilite;

use App\Stripe\checkout_session;


Class StripeService{

    private $privateKey;

    public function __construct()
    {
        $_ENV['APP_ENV'] === 'dev';
        $this->privateKey = $_ENV['STRIPE_SECRET_KEY_LIVE'];
        
    }
    /**
     * @param Coachs $coachs
     * @return \Stripe\PaymentIntent
     * @\Stripe\Exception\ApiErrorException
     */
    public function paymentIntent(Coachs $coachs, Reservation $reservation)
    {
        Stripe\StripeService::SetApiKey($this->privateKey);

        return stripe\StripeService\PaymentIntent::create([
            'amount' => $coachs->getPrix() = 100,
            'currency' => Reservation::DEVISE,
            'payment_method_type'=>('card'),
        ]); 
    }

    public function payment($amount, $currency,$description,array $stripeParameter)
    {
        Stripe\StripeService::SetApiKey($this->privateKey);
        $payment_intent = null;
        if (isset($stripeParameter['stripeIntentId'])){
            $payment_intent = \Stripe\PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
        }
        
        if($stripeParameter['stripeIntendId'] === 'success'){
            //TODO
        } else {
            $payment_intent->cancel();
        }
        
        return $payment_intent;
    }

    /**
     * @param array $stripeParameter
     * @param Coachs $coach
     * @\Stripe\PaymentIntent|null
     */
    public function stripe(array $stripeParameter, Coachs $coachs)
    {
        return $this->payment(
            amount:$coachs->getPrix() *100,
            currency:Reservation::DEVISE,
            $coachs->getId(),
            $stripeParameter
        );

    }

}
