<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 03/11/2019
 * Time: 11:20
 */

namespace App\Controller;


use App\Document\Produit;
use App\Form\ProduitType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController

{
    /**
     * @Route("/creer_produit")
     *
     */
    public function create(Request $request,DocumentManager $dm){

        $produit = new Produit();
        $form= $this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dm->persist($produit);
            $dm->flush();
            return $this->redirectToRoute('app_produit_liste');
        }
        return $this->render("produit/form.html.twig", [
            'produitForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/modifier")
     *
     */
    public function update(Request $request, DocumentManager $dm,$id)
    {

        $produitRepository=$dm->getRepository(Produit::class);
        $produit=$produitRepository->find($id);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $dm->persist($produit);
            $dm->flush();

            //$this->addFlash('success', 'Le Compte utilisateur a bien éte crée.');
            return $this->redirectToRoute('app_produit_liste');
        }

        return $this->render("produit/form.html.twig", [
            'produitForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}/supprimer")
     */
    public function delete(Request $request,$id,DocumentManager $dm){

        $produitRepository=$dm->getRepository(Produit::class);
        $produit=$produitRepository->find($id);
        $dm->remove($produit);
        $dm->flush();

        return $this->redirectToRoute("app_produit_liste");


    }

    /**
     * @Route("/liste")
     */
    public function liste(DocumentManager $dm){

        $produitRepository=$dm->getRepository(Produit::class);
        $produits=$produitRepository->findBy(
            [],
            ['nom' =>'ASC']
        );
        // var_dump($users);die;
        return $this->render("produit/liste.html.twig",[
            'produits' =>$produits
        ]);
    }

}