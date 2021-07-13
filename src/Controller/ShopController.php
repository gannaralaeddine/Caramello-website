<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{

    /**
     * @Route("/boutique", name="shop")
     */
    public function getProducts(ProduitRepository $repo)
    {
        $produits = $repo->findAll();
        return $this->render("front/shop.html.twig",['produits'=>$produits]);
    }
}
