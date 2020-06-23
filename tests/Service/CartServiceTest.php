<?php
namespace App\Tests\Util;

use App\Entity\Product;
use App\Service\CartService;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

class CartServiceTest extends KernelTestCase
{
    /** @var CartService */
    private $cartService;

    public function setUp() {
        self::bootKernel();
        $this->cartService = self::$kernel->getContainer()->get('cart.service');

        $session = new Session(new MockArraySessionStorage());
        $this->cartService->setSession($session);
    }


    public function initProduct($id,$name,$description,$price) {
        $product = new Product();
        $product->setId($id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        return $product;
    }

    public function testAddToCart() {
        $this->cartService->setCart(array());
        $this->cartService->addToCart(0,2);
        $this->cartService->addToCart(1,5);

        $cart = $this->cartService->getCart();
        
        $this->assertEquals(2, $cart[0]);
        $this->assertEquals(5, $cart[1]);
        $this->assertCount(2, $cart);
    }

    public function testGetAmountTotalCart()
    {
        $products = array();
        $products[0] = self::initProduct(0,"Product 0","Description 0",15);
        $products[1] = self::initProduct(1,"Product 1","Description 1",17);
        $products[2] = self::initProduct(2,"Product 2","Description 2",4);

        $this->cartService->setCart(array());
        $this->cartService->addToCart(0,10);
        $this->cartService->addToCart(1,1);
        $this->cartService->addToCart(2,4);

        $amount = $this->cartService->getAmountTotalCart($products);

        $this->assertEquals(183, $amount);
    }
}
?>