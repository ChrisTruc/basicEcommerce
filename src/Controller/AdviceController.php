<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdviceController extends AbstractController
{
    /**
     * @Route("/advice", name="advice")
     */
    public function index()
    {
        return $this->render('advice/index.html.twig', [
            'controller_name' => 'AdviceController',
        ]);
    }
}
