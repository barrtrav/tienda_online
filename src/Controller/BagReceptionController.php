<?php

namespace App\Controller;

use App\Entity\BagReception;
use App\Form\BagReception1Type;
use App\Repository\BagReceptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bag/reception")
 */
class BagReceptionController extends AbstractController
{
    /**
     * @Route("/", name="app_bag_reception_index", methods={"GET"})
     */
    public function index(BagReceptionRepository $bagReceptionRepository): Response
    {
        return $this->render('bag_reception/index.html.twig', [
            'bag_receptions' => $bagReceptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_bag_reception_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BagReceptionRepository $bagReceptionRepository): Response
    {
        $bagReception = new BagReception();
        $form = $this->createForm(BagReception1Type::class, $bagReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bagReceptionRepository->add($bagReception, true);

            return $this->redirectToRoute('app_bag_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bag_reception/new.html.twig', [
            'bag_reception' => $bagReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bag_reception_show", methods={"GET"})
     */
    public function show(BagReception $bagReception): Response
    {
        return $this->render('bag_reception/show.html.twig', [
            'bag_reception' => $bagReception,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_bag_reception_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BagReception $bagReception, BagReceptionRepository $bagReceptionRepository): Response
    {
        $form = $this->createForm(BagReception1Type::class, $bagReception);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bagReceptionRepository->add($bagReception, true);

            return $this->redirectToRoute('app_bag_reception_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bag_reception/edit.html.twig', [
            'bag_reception' => $bagReception,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bag_reception_delete", methods={"POST"})
     */
    public function delete(Request $request, BagReception $bagReception, BagReceptionRepository $bagReceptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bagReception->getId(), $request->request->get('_token'))) {
            $bagReceptionRepository->remove($bagReception, true);
        }

        return $this->redirectToRoute('app_bag_reception_index', [], Response::HTTP_SEE_OTHER);
    }
}
