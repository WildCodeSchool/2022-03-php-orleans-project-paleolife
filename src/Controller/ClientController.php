<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/profil')]
class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client_index', methods: ['GET'])]
    #[IsGranted('ROLE_CLIENT')]
    public function index(): Response
    {
        $client = $this->getUser()->getClient();
        return $this->render('client/index.html.twig', [
            'client' => $client,
        ]);
    }
}
