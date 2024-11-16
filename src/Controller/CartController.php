<?php

namespace App\Controller;

use App\Entity\Bag;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart")
     */
    public function index(): Response
    {
        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }

    /**
     * @Route("/cart/checkout", name="cart_checkout", methods={"GET", "POST"})
     */
    public function checkout(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        $content = $request->getContent();
        $data = json_decode($content, true);
        try {
            if ($request->isMethod('POST')) {
                if (!isset($data['province']) || !isset($data['municipality']) || !isset($data['address']) || !isset($data['cart'])) 
                { 
                    return $this->json(['error' => 'Invalid data provided'], Response::HTTP_BAD_REQUEST);
                }
                // Crear una nueva orden
                $order = new Order(); 
                $order->setUser($user); 
                $order->setPurchaseDate(new \DateTime('now')); 
                $order->setProvince($data['province']); 
                $order->setMunicipality($data['municipality']); 
                $order->setAddress($data['address']); 
                $order->setTotalItems(count($data['cart']));

                // Calcular el totalAmount sumando los precios de los productos 
                $totalAmount = 0; 
                foreach ($data['cart'] as $productData) { 
                    $product = $em->getRepository(Product::class)->find($productData['id']); 
                    if ($product) { 
                        $totalAmount += $product->getPrice(); 
                    } 
                } 
                $order->setTotalAmount($totalAmount);

                $em->persist($order);
                $em->flush(); // Flush here to get the order ID

                // // Crear bolsas y asociarlas a la orden
                $bag = new Bag();
                $bag->setCode(uniqid());
                $bag->setOrder($order);

                // Redirigir al usuario a la página de confirmación
                return $this->json([
                    'redirect_url' => $this->generateUrl(
                        'order_confirmation',
                        ['id' => $order->getId()]
                    )
                ]);
            }
        } catch (\Exception $e) {
            // Capturar la excepción y devolver una respuesta JSON 
            return $this->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->render('cart/checkout.html.twig');
    }

    /**
     * @Route("/order/confirmation/{id}", name="order_confirmation")
     */
    public function confirmation(Order $order): Response
    {
        return $this->render('cart/confirmation.html.twig', [
            'order' => $order,
        ]);
    }
}
