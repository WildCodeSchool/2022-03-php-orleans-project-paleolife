<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\NutritionMeal;
use App\Form\NutritionMealType;
use App\Repository\NutritionMealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/nutrition')]
class NutritionMealController extends AbstractController
{
    #[Route('/', name: 'app_nutrition_meal_index', methods: ['GET'])]
    public function index(NutritionMealRepository $nMealRepository): Response
    {
        return $this->render('nutrition_meal/index.html.twig', [
            'nutrition_meals' => $nMealRepository->findAll(),
        ]);
    }

    #[Route('/{id}/ajouter', name: 'app_nutrition_meal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NutritionMealRepository $nMealRepository, Client $client): Response
    {
        $nutritionMeal = new NutritionMeal();
        $nutritionMeal->setClient($client);
        $form = $this->createForm(NutritionMealType::class, $nutritionMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nMealRepository->add($nutritionMeal, true);

            $this->addFlash('success', 'Vous avez bien ajouté un repas');
            return $this->redirectToRoute('app_client_edit', [
                'id' => $nutritionMeal->getClient()->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('nutrition_meal/new.html.twig', [
            'nutrition_meal' => $nutritionMeal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nutrition_meal_show', methods: ['GET'])]
    public function show(NutritionMeal $nutritionMeal): Response
    {
        return $this->render('nutrition_meal/show.html.twig', [
            'nutrition_meal' => $nutritionMeal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_nutrition_meal_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        NutritionMeal $nutritionMeal,
        NutritionMealRepository $nMealRepository
    ): Response {
        $form = $this->createForm(NutritionMealType::class, $nutritionMeal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nMealRepository->add($nutritionMeal, true);
            $this->addFlash('success', 'Vous avez bien modifié le programme nutritionnel du client');

            return $this->redirectToRoute(
                'app_client_edit',
                ['id' => $nutritionMeal->getClient()->getId()],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->renderForm('nutrition_meal/edit.html.twig', [
            'nutrition_meal' => $nutritionMeal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_nutrition_meal_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        NutritionMeal $nutritionMeal,
        NutritionMealRepository $nMealRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $nutritionMeal->getId(), $request->request->get('_token'))) {
            $nMealRepository->remove($nutritionMeal, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
