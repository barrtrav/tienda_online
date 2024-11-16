<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        $productRepository = $this->getDoctrine()->getRepository(Product::class);
        $products = $productRepository->findAll();
        $recommendedProducts = $this->getRandomProducts($products, 4);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'recommended_products' => $recommendedProducts,
        ]);
    }

    private function getRandomProducts(array $products, int $limit): array
    {
        shuffle($products);
        return array_slice($products, 0, $limit);
    }
}
