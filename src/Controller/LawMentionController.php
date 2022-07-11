<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LawMentionController extends AbstractController
{
    #[Route('/mentions-legales', name: 'law_mention')]
    public function index(): Response
    {
        return $this->render('lawMention/index.html.twig');
    }
}
