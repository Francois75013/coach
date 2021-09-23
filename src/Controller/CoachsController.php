<?php

namespace App\Controller;

use App\Entity\Coachs;
use App\Form\CoachsType;
use App\Repository\CoachsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/coachs')]
class CoachsController extends AbstractController
{
    #[Route('/', name: 'coachs_index', methods: ['GET'])]
    public function index(CoachsRepository $coachsRepository): Response
    {
        return $this->render('coachs/index.html.twig', [
            'coachs' => $coachsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'coachs_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $coach = new Coachs();
        $form = $this->createForm(CoachsType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coach);
            $entityManager->flush();

            return $this->redirectToRoute('coachs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coachs/new.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'coachs_show', methods: ['GET'])]
    public function show(Coachs $coach): Response
    {
        return $this->render('coachs/show.html.twig', [
            'coach' => $coach,
        ]);
    }

    #[Route('/{id}/edit', name: 'coachs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Coachs $coach): Response
    {
        $form = $this->createForm(CoachsType::class, $coach);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coachs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('coachs/edit.html.twig', [
            'coach' => $coach,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'coachs_delete', methods: ['POST'])]
    public function delete(Request $request, Coachs $coach): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coach->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coach);
            $entityManager->flush();
        }

        return $this->redirectToRoute('coachs_index', [], Response::HTTP_SEE_OTHER);
    }
}
