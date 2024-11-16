<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            WarehouseFixtures::class,
            DistributionCenterFixtures::class,
        ];
    }
}
