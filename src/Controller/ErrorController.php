<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/error')]
class ErrorController extends AbstractController
{
    #[Route('/403', name: 'app_error_403', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('403.html.twig', []);
    }
}
