<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\MeasurementClient;
use App\Entity\Session;
use App\Form\ClientType;
use App\Form\ProfilClientType;
use App\Repository\ClientRepository;
use App\Repository\MeasurementRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/profil')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_CLIENT')]
    public function index(): Response
    {
        /** @var User  */
        $user = $this->getUser();
        $client = $user->getClient();

        return $this->render('client/index.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/modifier-profil', name: 'client_edit_profil', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_CLIENT')]
    public function editProfil(
        Request $request,
        ClientRepository $clientRepository,
        MeasurementRepository $measureRepository
    ): Response {

        /** @var User  */
        $user = $this->getUser();
        $client = $user->getClient();
        $actualMeasureClients = $client->getMeasurementClients();
        $measurements = $measureRepository->findAll();

        foreach ($measurements as $measurement) {
            $create = true;
            foreach ($actualMeasureClients as $actualMeasureClient) {
                if ($actualMeasureClient->getMeasurement() === $measurement) {
                    $create = false;
                }
            }
            if ($create) {
                $measureClient = new MeasurementClient();
                $measureClient->setMeasurement($measurement);
                $client->addMeasurementClient($measureClient);
            }
        }

        $form = $this->createForm(ProfilClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->add($client, true);
            $this->addFlash('success', 'Votre profil à bien été modifié !');

            return $this->redirectToRoute('client_edit_profil', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('client/edit.html.twig', [
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('admin/{id}/edit', name: 'app_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        $sessions = $client->getSessions();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clientRepository->add($client, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('adminClient/edit.html.twig', [
            'sessions' => $sessions,
            'client' => $client,
            'form' => $form,
        ]);
    }

    #[Route('admin/{id}', name: 'app_client_delete', methods: ['POST'])]
    public function delete(Request $request, Client $client, ClientRepository $clientRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $client->getId(), $request->request->get('_token'))) {
            $clientRepository->remove($client, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/comment/add/{session}', name: 'app_comment_add', methods: ['GET', 'POST'])]
    public function addComment(SessionRepository $sessionRepository, Session $session, Request $request): Response
    {
        if ($this->isCsrfTokenValid('add' . $session->getId(), $request->request->get('_token'))) {
            $session->setComment($request->request->get('comment'));
            $sessionRepository->add($session, true);
        }

        return $this->redirectToRoute('app_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
