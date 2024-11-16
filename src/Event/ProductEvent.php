<?php
// src/Event/ProductEvent.php
namespace App\Event;

use App\Entity\Product;
use Symfony\Contracts\EventDispatcher\Event;

class ProductEvent extends Event
{
    public const NAME = 'product.event';

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
