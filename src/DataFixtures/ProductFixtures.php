<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\TypeProduct;
use App\Entity\Advice;
use App\DataFixtures\TypeProductFixtures;
use App\Object\Enum\ProductTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Collections\ArrayCollection;

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
            for ($j = 0; $j < mt_rand(1, 5); $j++) {
                $advice = new Advice();
                $advice->setQuality(mt_rand(1, 10));
                $advice->setPrice(mt_rand(1, 10));
                $product->addAdvice($advice);
            }
            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TypeProductFixtures::class
        );
    }
}
?>
