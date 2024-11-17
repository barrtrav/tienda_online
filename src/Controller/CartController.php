<?php

namespace App\Controller;

use App\Entity\Bag;
use App\Entity\BagReception;
use App\Entity\Order;
use App\Entity\Product;
use App\Entity\Warehouse;
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
                $bags = []; 
                $productsByWarehouse = [];
                foreach ($data['cart'] as $productData) { 
                    $product = $em->getRepository(Product::class)->find($productData['id']); 
                    if ($product) { 
                        $totalAmount += $product->getPrice();
                        $warehouseId = $product->getWarehouse()->getId();
                        if (!isset($productsByWarehouse[$warehouseId])) { 
                            $productsByWarehouse[$warehouseId] = []; 
                        } 
                        $productsByWarehouse[$warehouseId][] = $product;
                    } 
                }
                // Crear bolsas y asignarlas a los centros de distribución 
                foreach ($productsByWarehouse as $warehouseId => $products) {
                    $bag = new Bag(); 
                    $bag->setCode(uniqid());
                    $bag->setCreationDate(new \DateTime('now'));
                    $bag->setOrder($order);

                    foreach ($products as $product) { 
                        $bag->addProduct($product); 
                    }

                    // Asignar bolsa a un centro de distribución 
                    $warehouse = $em->getRepository(Warehouse::class)->find($warehouseId); 
                    $distributionCenter = $warehouse->getDistributionCenter();
                    if ($distributionCenter) {
                        $bagReception = new BagReception();
                        $bagReception->setDistributionCenter($distributionCenter);
                        $bagReception->setBag($bag);
                        $bagReception->setBagCode($bag->getCode());
                        $bagReception->setReceptionDate(new \DateTime('now')); 
                        $bagReception->setResponsable($distributionCenter->getResponsable());
                        $bagReception->setQrCode(uniqid('QR_'));

                        $em->persist($bagReception); 
                        $distributionCenter->addBagReception($bagReception); 
                        
                        // Agregar bolsa al array de bolsas de la orden 
                        $bags[] = $bag;
                     }
                    else {
                        throw new \Exception('Distribution center not found for warehouse ID: ' . $warehouseId);
                    }
                    $em->persist($bag);
                }
                $order->setTotalAmount($totalAmount);

                $em->persist($order);
                $em->flush(); // Flush here to get the order ID

                // Redirigir al usuario a la página de confirmación
                return $this->json([
                    'redirect_url' => $this->generateUrl(
                        'order_choose_payment',
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
     * @Route("/order/choose-payment/{id}", name="order_choose_payment")
     */
    public function choosePayment(Order $order): Response
    {
        return $this->render('cart/choose_payment.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/confirmation/{id}", name="order_confirmation", methods={"GET"})
     */
    public function confirmation(Order $order, Request $request): Response { 
        // Guardar el método de pago seleccionado 
        // $paymentMethod = $request->request->get('payment_method'); 
        // $order->setPaymentMethod($paymentMethod); 
        
        // Mostrar la página de confirmación con los detalles de la compra 
        return $this->render('cart/confirmation.html.twig', [ 'order' => $order, ]);
    }

    /** 
     * @Route("/order/shipping-confirmation/{id}", name="shipping_confirmation") 
     */ 
    public function shippingConfirmation(Order $order, Request $request, EntityManagerInterface $em): Response
{
    // Enviar correo de confirmación (ejemplo usando SwiftMailer)

    // Limpiar el carrito
    // Suponiendo que esta usando sesiones para el carrito

    // Redirigir a la página de confirmación de envío
    return $this->render('cart/shipping_confirmation.html.twig', [
        'order' => $order,
        'message' => 'El envío se ha confirmado y se ha enviado un correo electrónico al cliente.'
    ]);
}
/**
     * @Route("/order/cancel/{id}", name="cancel_order")
     */
    public function cancelOrder(Order $order, EntityManagerInterface $em): Response
    {
        // Eliminar las entidades relacionadas con la orden
        foreach ($order->getBags() as $bag) {
            $bagReceptions = $em->getRepository(BagReception::class)->findBy(['bag' => $bag]);
            foreach ($bagReceptions as $bagReception) {
                $em->remove($bagReception);
            }
            $em->remove($bag);
        }
        

        // Eliminar la orden
        $em->remove($order);
        $em->flush();

        // Redirigir a la página de inicio con un mensaje de cancelación
        return $this->redirectToRoute('app_home', [
            'message' => 'La orden ha sido cancelada con éxito.'
        ]);
    }
}
