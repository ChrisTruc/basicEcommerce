<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public const NB_PRODUCTS = 12;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('description '.$i);
            $product->setPrice(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();
    }
}
