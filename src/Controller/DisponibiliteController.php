<?php

namespace App\Controller;

use App\Entity\Disponibilite;
use App\Repository\ReservationRepository;
use App\Repository\DisponibiliteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\DisponibiliteType;
use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\HttpFoundation\Request;



class DisponibiliteController extends AbstractController
{
/*    
    public function index(): Response
    {
        return $this->render('disponibilite/index.html.twig', [
            'controller_name' => 'DisponibiliteController',
        ]);
    } */
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('debut', DateTimeType::class)
        ->add('fin', DateTimeType::class)
        ->add('coach')
        ->add('lieu')
    ;
    }
    #[Route('/disponibilite', name: 'disponibilite')]
    public function agenda(Request $request)
    {
        $disponibilite = new Disponibilite();
        $form = $this->createForm(DisponibiliteType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($disponibilite);
        $entityManager->flush();
        // Message flash
        $this->addFlash('message','Nouvelle disponibilité ajoutée avec succès');

        return $this->redirectToRoute('index');
       
        };


        return $this->render('/disponibilite/agenda.html.twig', [
                'disponibiliteType' =>$form->createView(),
        ]);
    }

    #[Route('/detail_coach/{id}/reservation', name: 'reservation')]
    public function resa( ReservationRepository $reservationRepository, DisponibiliteRepository $disponibiliteRepository, $coach_id): Response
    {
        $resas = $this->getDoctrine()->getRepository(Reservation::class)->findAll();
        $dispos = $this->getDoctrine()->getRepository(Disponibilite::class)->findAll();
        $repo = $this->getDoctrine()->getRepository(Disponibilite::class);
        $dispo = $repo->find($coach_id);
        $id = $this->getDoctrine()->getRepository(Disponibilite::class)->findOneBy([]);

        return $this->render('reservation.html.twig', [
            
            'dispos' => $dispos,
            'dispo' =>$dispo
         
        ]);
    }
}