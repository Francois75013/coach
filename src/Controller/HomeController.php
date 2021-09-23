<?php

namespace App\Controller;
use App\Entity\Coachs;
use App\Repository\CoachsRepository;
use App\Entity\Reservations;
use App\Repository\ReservationsRepository;
use AppController\CoachController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        $coachs = $this->getDoctrine()->getRepository(Coachs::class)->findAll();
        return $this->render('home/index.html.twig', [
            'coachs' => $coachs,
        ]);
    }
    
    #[Route('/', name: 'index')]
    public function coachs(CoachsRepository $coachsRepository): Response
    {
        $coachs = $this->getDoctrine()->getRepository(Coachs::class)->findAll();
        $id = $this->getDoctrine()->getRepository(Coachs::class)->findOneBy([]);

        return $this->render('home/index.html.twig', 
            compact('coachs'),
        );
        
    }

     /**
     * @Route("/detail_coach/{id}", name="detail_coach")
     */
    public function detail_coach($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Coachs::class);
        $coach = $repo->find($id);
        

        return $this->render('detail_coach.html.twig', [
            'coach' => $coach,
            
        ]);
    }

     /**
     * @Route("/page_user", name="page_user")
     */
    public function page_user(reservationsRepository $reservationsRepository): Response
    {
        $resa = $this->getDoctrine()->getRepository(Reservations::class)->findAll();
      
        return $this->render('page_user.html.twig', [
            'resa' => $resa,
        ]);
    }
      /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('contact.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
     /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    /**
     * @Route("/pol_confidential", name="pol_confidential")
     */
    public function pol_confidential(): Response
    {
        return $this->render('pol_confidential.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}
