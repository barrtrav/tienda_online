<?php

namespace App\Controller;

use App\Entity\Bag;
use App\Form\Bag1Type;
use App\Repository\BagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bag")
 */
class BagController extends AbstractController
{
    /**
     * @Route("/", name="app_bag_index", methods={"GET"})
     */
    public function index(BagRepository $bagRepository): Response
    {
        return $this->render('bag/index.html.twig', [
            'bags' => $bagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_bag_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BagRepository $bagRepository): Response
    {
        $bag = new Bag();
        $form = $this->createForm(Bag1Type::class, $bag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bagRepository->add($bag, true);

            return $this->redirectToRoute('app_bag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bag/new.html.twig', [
            'bag' => $bag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bag_show", methods={"GET"})
     */
    public function show(Bag $bag): Response
    {
        return $this->render('bag/show.html.twig', [
            'bag' => $bag,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_bag_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bag $bag, BagRepository $bagRepository): Response
    {
        $form = $this->createForm(Bag1Type::class, $bag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bagRepository->add($bag, true);

            return $this->redirectToRoute('app_bag_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bag/edit.html.twig', [
            'bag' => $bag,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_bag_delete", methods={"POST"})
     */
    public function delete(Request $request, Bag $bag, BagRepository $bagRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bag->getId(), $request->request->get('_token'))) {
            $bagRepository->remove($bag, true);
        }

        return $this->redirectToRoute('app_bag_index', [], Response::HTTP_SEE_OTHER);
    }
}
