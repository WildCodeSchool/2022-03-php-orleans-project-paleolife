<?php

namespace App\Controller;

use App\Entity\Measurement;
use App\Form\MeasurementType;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/mensuration')]
class MeasurementController extends AbstractController
{
    #[Route('/', name: 'app_measurement_index', methods: ['GET'])]
    public function index(MeasurementRepository $measureRepository): Response
    {
        return $this->render('measurement/index.html.twig', [
            'measurements' => $measureRepository->findAll(),
        ]);
    }

    #[Route('/ajouter-mensuration', name: 'app_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MeasurementRepository $measureRepository): Response
    {
        $measurement = new Measurement();
        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $measureRepository->add($measurement, true);

            $this->addFlash('success', 'Mensuration bien enregistrée !');
            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/new.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_show', methods: ['GET'])]
    public function show(Measurement $measurement): Response
    {
        return $this->render('measurement/show.html.twig', [
            'measurement' => $measurement,
        ]);
    }

    #[Route('/{id}/modifier-mensuration', name: 'app_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Measurement $measurement, MeasurementRepository $measureRepository): Response
    {
        $form = $this->createForm(MeasurementType::class, $measurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $measureRepository->add($measurement, true);

            $this->addFlash('success', 'Mensuration bien mofdifiée !');
            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('measurement/edit.html.twig', [
            'measurement' => $measurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_measurement_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Measurement $measurement,
        MeasurementRepository $measureRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $measurement->getId(), $request->request->get('_token'))) {
            $measureRepository->remove($measurement, true);
        }

        $this->addFlash('danger', 'Mensuration supprimée !');
        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }
}
