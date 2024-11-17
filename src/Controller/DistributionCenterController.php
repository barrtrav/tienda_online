<?php

namespace App\Controller;

use App\Entity\DistributionCenter;
use App\Form\DistributionCenter1Type;
use App\Repository\DistributionCenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/distribution/center")
 */
class DistributionCenterController extends AbstractController
{
    /**
     * @Route("/", name="app_distribution_center_index", methods={"GET"})
     */
    public function index(DistributionCenterRepository $distributionCenterRepository): Response
    {
        return $this->render('distribution_center/index.html.twig', [
            'distribution_centers' => $distributionCenterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_distribution_center_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DistributionCenterRepository $distributionCenterRepository): Response
    {
        $distributionCenter = new DistributionCenter();
        $form = $this->createForm(DistributionCenter1Type::class, $distributionCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $distributionCenterRepository->add($distributionCenter, true);

            return $this->redirectToRoute('app_distribution_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('distribution_center/new.html.twig', [
            'distribution_center' => $distributionCenter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_distribution_center_show", methods={"GET"})
     */
    public function show(DistributionCenter $distributionCenter): Response
    {
        return $this->render('distribution_center/show.html.twig', [
            'distribution_center' => $distributionCenter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_distribution_center_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, DistributionCenter $distributionCenter, DistributionCenterRepository $distributionCenterRepository): Response
    {
        $form = $this->createForm(DistributionCenter1Type::class, $distributionCenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $distributionCenterRepository->add($distributionCenter, true);

            return $this->redirectToRoute('app_distribution_center_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('distribution_center/edit.html.twig', [
            'distribution_center' => $distributionCenter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_distribution_center_delete", methods={"POST"})
     */
    public function delete(Request $request, DistributionCenter $distributionCenter, DistributionCenterRepository $distributionCenterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$distributionCenter->getId(), $request->request->get('_token'))) {
            $distributionCenterRepository->remove($distributionCenter, true);
        }

        return $this->redirectToRoute('app_distribution_center_index', [], Response::HTTP_SEE_OTHER);
    }
}
