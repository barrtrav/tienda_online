<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Warehouse;
use App\Entity\DistributionCenter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Crear almacenes y centros de distribución
        $warehouses = [];
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
            $warehouses[] = $warehouse;

            // Crear centro de distribución y asignarlo al almacén
            $distributionCenter = new DistributionCenter();
            $distributionCenter->setName($faker->company);
            $distributionCenter->setResponsable($faker->name);
            $distributionCenter->setBagsDelivered($faker->numberBetween(100, 500));
            $distributionCenter->setDeliveryDate($faker->dateTimeBetween('-2 years', 'now'));
            $distributionCenter->setWarehouse($warehouse);
            $manager->persist($distributionCenter);

            // Asignar el centro de distribución al almacén
            $warehouse->setDistributionCenter($distributionCenter);

            echo "Almacén {$i} creado: {$warehouse->getName()} con Centro de Distribución: {$distributionCenter->getName()}\n";
        }

        // Crear productos y asignarlos a los almacenes
        $productNames = [
            'Televisor LED', 'Lavadora Automática', 'Refrigerador', 'Microondas', 'Aspiradora',
            'Cafetera', 'Licuadora', 'Tostadora', 'Plancha', 'Secadora de Ropa',
            'Ventilador', 'Aire Acondicionado', 'Calefactor', 'Horno Eléctrico', 'Batidora',
            'Exprimidor de Jugos', 'Freidora de Aire', 'Máquina de Coser', 'Robot de Cocina',
            'Humidificador', 'Deshumidificador', 'Purificador de Aire', 'Termo Eléctrico',
            'Estufa de Gas', 'Lavavajillas', 'Helado de Vainilla', 'Pizza Congelada', 'Carne de Res',
            'Pescado', 'Pollo', 'Ensalada', 'Frutas Frescas', 'Verduras Congeladas', 'Yogur',
            'Queso', 'Leche', 'Pan', 'Galletas', 'Cereal'
        ];
        $temperatures = [
            'Ambient', 'Ambient', 'Chilled', 'Ambient', 'Ambient',
            'Ambient', 'Ambient', 'Ambient', 'Ambient', 'Ambient',
            'Ambient', 'Chilled', 'Ambient', 'Ambient', 'Ambient',
            'Ambient', 'Ambient', 'Ambient', 'Ambient', 'Ambient',
            'Ambient', 'Ambient', 'Ambient', 'Ambient', 'Ambient',
            'Frozen', 'Frozen', 'Frozen', 'Frozen', 'Frozen',
            'Chilled', 'Chilled', 'Frozen', 'Chilled', 'Chilled',
            'Chilled', 'Ambient', 'Ambient', 'Ambient'
        ];
        for ($i = 0; $i < count($productNames); $i++) {
            $product = new Product();
            $product->setCode($faker->unique()->numerify("PR###"));
            $product->setCreationDate($faker->dateTimeBetween('-1 years', 'now'));
            $product->setName($productNames[$i]);
            $product->setNameTranslate($faker->word);
            $product->setWight($faker->randomFloat(2, 0.1, 10));
            $product->setVolume($faker->randomFloat(2, 0.1, 10));
            $product->setBrand($faker->company);
            $product->setDescription($faker->sentence);
            $product->setTemperature($faker->randomElement(['Ambient', 'Chilled', 'Frozen']));
            $product->setPrice($faker->randomFloat(2, 1, 100));

            $warehouse = $warehouses[array_rand($warehouses)];
            $product->setWarehouse($warehouse);
            $manager->persist($product);

            echo "Producto {$i} creado: {$product->getName()} asignado al Almacén: {$warehouse->getName()}\n";
        }

        $manager->flush();
    }
}
