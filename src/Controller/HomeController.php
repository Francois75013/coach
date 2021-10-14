<?php

namespace App\Controller;
use App\Entity\Coachs;
use App\Repository\CoachsRepository;
use App\Entity\Reservation;
use App\Entity\Disponibilite;
use App\Repository\DisponibiliteRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
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

  
    #[Route('/detail_coach/{id}', name: 'detail_coach')]
    public function detail_coach($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Coachs::class);
        $coach = $repo->find($id);
        

        return $this->render('detail_coach.html.twig', [
            'coach' => $coach,
            
        ]);
    }


    #[Route('/page_user', name: 'page_user')]
    public function page_user(ReservationRepository $reservationRepository): Response
    {
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $id = $this->getDoctrine()->getRepository(Reservation::class)->findOneBy([]);

        return $this->render('page_user.html.twig', [
            'resas' => $resas,
            'id' => $id,
        ]);
    }

    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('login.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/pol_confidential', name: 'pol_confidential')]
    public function pol_confidential(): Response
    {
        return $this->render('pol_confidential.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
 /*    #[Route('/detail_coach/{id}/paiement', name: 'paiement')]
    public function paiement($id): Response
    {   
        $repo = $this->getDoctrine()->getRepository(Coachs::class);
        $coach = $repo->find($id);
        $coachs = $repo->find($id);
        

        return $this->render('paiement.html.twig', [
            'coach' => $coach,
            'coachs' => $coachs
            
        ]);
    } */

    #[Route('/detail_coach/{id}/reservation', name: 'reservation')]
    public function resa( ReservationRepository $reservationRepository, DisponibiliteRepository $disponibiliteRepository): Response
    {
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $dispos = $this->getDoctrine()->getRepository(Disponibilite::class)->findAll();
        $repo = $this->getDoctrine()->getRepository(Disponibilite::class);
        $dispo = $repo->findOneBy([]);
        $id = $this->getDoctrine()->getRepository(Disponibilite::class)->findOneBy([]);
        $repo = $this->getDoctrine()->getRepository(Coachs::class);
        $coach = $repo->find($id);
        return $this->render('reservation.html.twig', [
            
            'dispos' => $dispos,
            'dispo' => $dispo,
            'coach' => $coach
         
        ]);
        
    }
    /* #[Route('/detail_coach/{id}/reservation', name: 'reservation')]
    public function resa( ReservationRepository $reservationRepository, DisponibiliteRepository $disponibiliteRepository): Response
    {
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $dispos = $this->getDoctrine()->getRepository(Disponibilite::class)->findAll();
        $repo = $this->getDoctrine()->getRepository(Disponibilite::class);
        $dispo = $repo->findOneBy([]);
        $id = $this->getDoctrine()->getRepository(Disponibilite::class)->findOneBy([]);

        return $this->render('reservation.html.twig', [
            
            'dispos' => $dispos,
            'dispo' =>$dispo
         
        ]);

    } */
    #[Route('/detail_coach/{id}/reservation', name: 'reservation')]
    public function formResa(Request $request, ReservationRepository $reservationRepository, DisponibiliteRepository $disponibiliteRepository)
    {
        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);
        return $this->render('StripeService.php', [
        ]);
    }
    
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request,\Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            // On crée le message
            $message = (new \Swift_Message('Nouveau message'))
                // On attribue l'expéditeur
                ->setFrom($contact['email'])
                // On attribue le destinataire
                ->setTo('clubatheon@gmail.com')
                // On crée le texte dans la vue
                ->setBody(
                    $this->renderView(
                        'contact.html.twig', compact('contact')
                    ),
                    'text/html'
                )
            ;
            $mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); //message flash de renvoi
        }
        return $this->render('contact.html.twig',['contactForm' => $form->createView()]);
    }
}
