<?php
// src/DataFixtures/DistributionCenterFixtures.php
namespace App\DataFixtures;

use App\Entity\DistributionCenter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class DistributionCenterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Generar datos falsos para 5 centros de distribución
        for ($i = 0; $i < 5; $i++) {
            $distributionCenter = new DistributionCenter();
            $distributionCenter->setName($faker->company);
            $distributionCenter->setResponsable($faker->name);
            $distributionCenter->setBagsDelivered($faker->numberBetween(100, 500));
            $distributionCenter->setDeliveryDate($faker->dateTimeBetween('-2 years', 'now'));
            $manager->persist($distributionCenter);

            // Mensaje de depuración
            echo "Centro de Distribución {$i} creado: {$distributionCenter->getName()}\n";
        }

        $manager->flush();

        echo "Datos de centros de distribución generados\n";
    }
}
