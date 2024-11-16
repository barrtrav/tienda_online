<?php
// src/EventSubscriber/EntityEventSubscriber.php
namespace App\EventSubscriber;

use App\Event\ProductEvent;
use App\Event\OrderEvent;
use App\Event\BagEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Psr\Log\LoggerInterface;

class EntityEventSubscriber implements EventSubscriberInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ProductEvent::NAME => 'onProductEvent',
            OrderEvent::NAME => 'onOrderEvent',
            BagEvent::NAME => 'onBagEvent',
        ];
    }

    public function onProductEvent(ProductEvent $event)
    {
        $product = $event->getProduct();
        // Lógica para manejar el evento del producto
        $this->logger->info('Product event triggered for product: '.$product->getName());
    }

    public function onOrderEvent(OrderEvent $event)
    {
        $order = $event->getOrder();
        // Lógica para manejar el evento de la orden
        $this->logger->info('Order event triggered for order ID: '.$order->getId());
    }

    public function onBagEvent(BagEvent $event)
    {
        $bag = $event->getBag();
        // Lógica para manejar el evento de la bolsa
        $this->logger->info('Bag event triggered for bag code: '.$bag->getCode());
    }
}
