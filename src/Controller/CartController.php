<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route("/calculPrice/{typeCalculPrice}", name="calculPrice")
     */
    public function calculPrice(CartService $cartService, Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $typePrice = $request->get('typeCalculPrice');

            $products = $this->getDoctrine()
                         ->getRepository(Product::class)
                         ->findById(array_keys($cartService->getCart()));

            if ($typePrice == "TOTAL") {
                $price = $cartService->getAmountTotalCart($products);
            }

            return new JsonResponse($price);
        }

        return $this->redirectToRoute('listProducts');
    }
}
