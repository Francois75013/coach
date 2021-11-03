<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/page_user', name: 'page_user')]
    public function index(): Response
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    
    #[Route('/checkout', name: 'checkout')]
    public function checkout(): Response
    {
        return $this->render('detail_coach/{id}/stripe/checkout.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    #[Route('/success', name: 'success')]
    public function success(): Response
    {
        return $this->render('/stripe/checkout.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
    #[Route('/cancel', name: 'cancel')]
    public function cancel(): Response
    {
        return $this->render('/stripe/checkout.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }
}
