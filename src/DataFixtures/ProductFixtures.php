<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\TypeProduct;
use App\DataFixtures\TypeProductFixtures;
use App\Object\Enum\ProductTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const NB_PRODUCTS = 12;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::NB_PRODUCTS; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setDescription('description '.$i);
            $product->setPrice(mt_rand(10, 100));
            $product->setTypeProduct($this->getReference(TypeProduct::class.'_'.($i%3)));
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TypeProductFixtures::class,
        );
    }
}
?>
