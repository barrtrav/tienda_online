<?php
// src/DataFixtures/WarehouseFixtures.php
namespace App\DataFixtures;

use App\Entity\Warehouse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class WarehouseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Generar datos falsos para 10 almacenes
        for ($i = 0; $i < 10; $i++) {
            $warehouse = new Warehouse();
            $warehouse->setCreationDate($faker->dateTimeBetween('-2 years', 'now'));
            $warehouse->setName($faker->company);
            $warehouse->setCode($faker->unique()->numerify("WH###"));
            $warehouse->setPhone($faker->phoneNumber);
            $warehouse->setAddress($faker->address);
            $warehouse->setActive($faker->boolean);
            $warehouse->setLatitude($faker->latitude);
            $warehouse->setLongitude($faker->longitude);
            $manager->persist($warehouse);

            // Mensaje de depuración
            echo "Almacén {$i} creado: {$warehouse->getName()}\n";
        }

        $manager->flush();

        echo "Datos de almacenes generados\n";
    }
}
