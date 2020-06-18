<?php

namespace App\Controller;

use App\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
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
    public function show(int $id) : Response
    {
        $product = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->find($id);        

        return $this->render('catalog/show.html.twig', [
            'product' => $product,
        ]);
    }
}
