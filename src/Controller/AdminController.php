<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ChallengeRepository;
use App\Repository\ClientRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/back", name="back")
     */
    public function index(): Response
    {
        return $this->render('back/base.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


//Gestion Produits ------------------------------------------------------------------------------------------------------------------------

    /**
     * @Route("/createProduct", name="createProduct")
     */
    public function CreateProduct(Request $request, ProduitRepository $repo)
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You must be ADMIN to access to this page");

        $produit = new Produit();
        //$image=new ChallengeTag();
        //$challenge->addTagChallenge($image);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->add("cancel", ButtonType::class);
        $form->add("submit", SubmitType::class, ['label'=>'Enregistrer']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirectToRoute('admin_listeProduits');
        }
        return $this->render('back/create_product.html.twig', ['form'=>$form->createView()] );
    }

    /**
     * @Route("/listeProduits", name="listeProduits")
     */
    public function getProducts(ProduitRepository $repo)
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You must be ADMIN to access to this page");
        $produits = $repo->findAll();
        return $this->render("back/product_list.html.twig",['produits'=>$produits]);
    }

    /**
     * @Route("/EditProduct/{id}", name="EditProduct")
     */
    public function EditProduct(Request $request, ProduitRepository $repo, $id)
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You must be ADMIN to access to this page");

        $produit = $repo->find($id);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->add('cancel', ButtonType::class);
        $form->add('submit', SubmitType::class, ['label'=>'Modifier']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('admin_listeProduits');
        }

        return $this->render("back/create_product.html.twig",['form'=>$form->createView()]);
    }

    /**
     * @Route("/DeleteProduct/{id}", name="DeleteProduct")
     */
    function DeleteProduct(ProduitRepository $repo, $id)
    {
        $produit = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('admin_listeProduits');
    }

//Gestion Users ------------------------------------------------------------------------------------------------------------------------

    /**
     * @Route("/getUsers", name="getUsers")
     */
    public function getUsers(ClientRepository $repo)
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, "You must be ADMIN to access to this page");
        $users = $repo->findAll();
        //$tagsChallenge=new TagsChallenge();
        return $this->render("back/display_users.html.twig",['users'=>$users]);
    }

    /**
     * @Route("/DeleteClient/{id}", name="DeleteClient")
     */
    function DeleteClient(ClientRepository  $repo, $id)
    {
        $client = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute('admin_getUsers');
    }

}
