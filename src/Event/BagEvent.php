<?php
// src/Event/BagEvent.php
namespace App\Event;

use App\Entity\Bag;
use Symfony\Contracts\EventDispatcher\Event;

class BagEvent extends Event
{
    public const NAME = 'bag.event';

    protected $bag;

    public function __construct(Bag $bag)
    {
        $this->bag = $bag;
    }

    public function getBag(): Bag
    {
        return $this->bag;
    }
}
