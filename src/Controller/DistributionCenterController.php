<?php

namespace App\Controller;

use App\Entity\Bag;
use App\Entity\BagReception;
use App\Entity\DistributionCenter;
use App\Form\DistributionCenterType;
use App\Repository\DistributionCenterRepository;
use Doctrine\ORM\EntityManagerInterface;
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
        $form = $this->createForm(DistributionCenterType::class, $distributionCenter);
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
        $form = $this->createForm(DistributionCenterType::class, $distributionCenter);
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

    /**
     * @Route("/distribution/receive", name="distribution_receive", methods={"GET", "POST"})
     */
    public function receive(Request $request, EntityManagerInterface $em): Response
    {
        $bagCode = $request->request->get('bag_code');
        $responsable = $this->getUser()->getUsername();
        $distributionCenterId = $request->request->get('distribution_center_id');
        $distributionCenter = $em->getRepository(DistributionCenter::class)->find($distributionCenterId);

        if ($request->isMethod('POST')) {
            $bag = $em->getRepository(Bag::class)->findOneBy(['code' => $bagCode]);

            if ($bag) {
                $bagReception = new BagReception();
                $bagReception->setBag($bag);
                $bagReception->setDistributionCenter($distributionCenter);
                $bagReception->setBagCode($bagCode);
                $bagReception->setReceptionDate(new \DateTime());
                $bagReception->setResponsable($responsable);

                $em->persist($bagReception);
                $em->flush();

                // Redirigir al usuario a la página de confirmación de recepción
                return $this->redirectToRoute('distribution_confirmation', ['id' => $bagReception->getId()]);
            }
        }

        $distributionCenters = $em->getRepository(DistributionCenter::class)->findAll();

        return $this->render('distribution/receive.html.twig', [
            'distribution_centers' => $distributionCenters,
        ]);
    }

    /**
     * @Route("/distribution/confirmation/{id}", name="distribution_confirmation")
     */
    public function confirmation(BagReception $bagReception): Response
    {
        return $this->render('distribution/confirmation.html.twig', [
            'bagReception' => $bagReception,
        ]);
    }
}
