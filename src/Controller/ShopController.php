<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/boutique", name="shop")
     */
    public function boutique(): Response
    {
        return $this->render('front/shop.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
}
