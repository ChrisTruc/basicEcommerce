<?php

namespace App\Controller;

use App\Entity\Product;

use App\Service\CartService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/list", name="listProducts")
     */
    public function listProducts(CartService $cartService)
    {
        $cart = $cartService->getCart();

        $products = $this->getDoctrine()
                         ->getRepository(Product::class)
                         ->findById(array_keys($cart));

        return $this->render('cart/list-products.html.twig', [
            'productsCart' => $products,
            'cart' => $cart
        ]);
    }

    /**
     * @Route("/deleteSession", name="deleteSession")
     */
    public function deleteSession(CartService $cartService)
    {
        $cartService->setCart(array());

        return $this->redirectToRoute('listProducts');
    }
}
