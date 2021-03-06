<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Exercise;
use App\Entity\Session;
use App\Form\SessionType;
use App\Repository\ExerciseRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/seance')]
class SessionController extends AbstractController
{
    #[Route('/', name: 'app_session_index', methods: ['GET'])]
    public function index(SessionRepository $sessionRepository): Response
    {
        return $this->render('session/index.html.twig', [
            'sessions' => $sessionRepository->findAll(),
        ]);
    }

    #[Route('/{id}/ajouter-seance', name: 'app_session_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SessionRepository $sessionRepository, Client $client): Response
    {
        $session = new Session();
        $session->setClient($client);
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sessionRepository->add($session, true);
            $this->addFlash('success', 'La séance à bien été ajoutée !');

            return $this->redirectToRoute('app_client_edit', [
                'id' => $session->getClient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/new.html.twig', [
            'client' => $client,
            'session' => $session,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/modifier-seance', name: 'app_session_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Session $session, SessionRepository $sessionRepository,): Response
    {
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sessionRepository->add($session, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('session/edit.html.twig', [
            'session' => $session,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_session_delete', methods: ['POST'])]
    public function delete(Request $request, Session $session, SessionRepository $sessionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $session->getId(), $request->request->get('_token'))) {
            $sessionRepository->remove($session, true);
            $this->addFlash('danger', 'La séance à bien été supprimée');
        }

        return $this->redirectToRoute('app_client_edit', [
            'id' => $session->getClient()->getId()
        ], Response::HTTP_SEE_OTHER);
    }
}
