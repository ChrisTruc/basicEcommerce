<?php

namespace App\DataFixtures;

use App\Entity\TypeProduct;
use App\Object\Enum\ProductTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeProductFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < ProductTypeEnum::countTypeProduct(); $i++) {
            $typeProduct = new TypeProduct();
            $typeProduct->setType(ProductTypeEnum::getValueEnumOfInt($i));
            $manager->persist($typeProduct);
            $this->addReference(TypeProduct::class. '_' . $i, $typeProduct);
        }

        $manager->flush();
    }
}
?>