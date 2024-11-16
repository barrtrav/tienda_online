<?php
// src/DataFixtures/ProductFixtures.php
namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

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

        // Generar datos falsos para 10 almacenes
        for ($i = 0; $i < 39; $i++) {
            $product = new Product();
            $product->setCode($faker->unique()->numerify("PR###"));
            $product->setCreationDate($faker->dateTimeBetween('-1 years', 'now'));
            $product->setName($productNames[$i]);
            $product->setNameTranslate($faker->firstName());
            $product->setWight($faker->randomFloat(2, 0.1, 10)); // Valores entre 0.1 y 10
            $product->setVolume($faker->randomFloat(2, 0.1, 10)); // Valores entre 0.1 y 10
            $product->setBrand($faker->text(20));
            $product->setDescription($faker->text(50));
            $product->setTemperature($temperatures[$i]);
            $product->setPrice($faker->randomFloat(2, 1, 100)); // Valores entre 1 y 100
            $manager->persist($product);

            // Mensaje de depuración
            echo "Almacén {$i} creado: {$product->getName()}\n";
        }

        $manager->flush();

        echo "Datos de almacenes generados\n";
    }
}
