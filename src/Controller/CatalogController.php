<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductPageType;

use App\Service\CartService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index() : Response
    {
        $products = $this->getDoctrine()
                         ->getRepository(Product::class)
                         ->findAll();
        
        return $this->render('catalog/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/show/{id}", name="show", requirements={"id"="\d+"})
     */
    public function show(Request $request, int $id, CartService $cartService) : Response
    {
        $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->find($id);
                        
        $form = $this->createForm(ProductPageType::class, []);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $cartService->addToCart($id, $item['quantity']);
        }

        return $this->render('catalog/show.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
