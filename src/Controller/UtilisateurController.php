<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 02/11/2019
 * Time: 10:42
 */

namespace App\Controller;



use App\Document\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/utilisateur")
 *
 */
class UtilisateurController extends AbstractController
{
    /**
     * @Route("/creer")
     *
     */
    public function create(Request $request, DocumentManager $dm,UserPasswordEncoderInterface $encoder)
    {

        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $rawPassword=$utilisateur->getRawPassword();
            $encoded=$encoder->encodePassword($utilisateur,$rawPassword);
            $utilisateur->setPassword($encoded);
            //$rawPassword=$utilisateur->getPassword();
            //$encoded=$encoder->encodePassword($utilisateur,$rawPassword);
            /*$utilisateur->setPassword("jhvchrv");
            $utilisateur->setEmail('');
            $utilisateur->setLastname('AZERTY');
            $utilisateur->setFirstname('');*/
            $dm->persist($utilisateur);
            $dm->flush();

            $this->addFlash('success', 'Le Compte utilisateur a bien éte crée.');
            return $this->redirectToRoute('app_utilisateur_create');
        }

        $utilisateurRepository=$dm->getRepository(Utilisateur::class);
        $users=$utilisateurRepository->findBy(
            [],
            ['lastname' =>'ASC']
        );

  /*      return $this->render("utilisateur/form.html.twig",[
            'users' =>$users
        ]);*/

        return $this->render("utilisateur/form.html.twig", [
            'clientForm' => $form->createView()
        ]);


    }

    /**
     * @Route("/{id}/modifier")
     *
     */
    public function update(Request $request, DocumentManager $dm,$id)
    {

        $utilisateurRepository=$dm->getRepository(Utilisateur::class);
        $utilisateur=$utilisateurRepository->find($id);
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //$rawPassword=$utilisateur->getPassword();
            //$encoded=$encoder->encodePassword($utilisateur,$rawPassword);
            /*$utilisateur->setPassword("jhvchrv");
            $utilisateur->setEmail('');
            $utilisateur->setLastname('AZERTY');
            $utilisateur->setFirstname('');*/
            $dm->persist($utilisateur);
            $dm->flush();

            $this->addFlash('success', 'Le Compte utilisateur a bien éte crée.');
            return $this->redirectToRoute('app_default_home');
        }

        return $this->render("utilisateur/form.html.twig", [
            'clientForm' => $form->createView()
        ]);
    }
    /**
     * @Route("/{id}/supprimer")
     */
    public function delete(Request $request,$id,DocumentManager $dm){

        $utilisateurRepository=$dm->getRepository(Utilisateur::class);
        //dump($id);die;
       //dump($utilisateurRepository->find($id));die;
       $utilisateur=$utilisateurRepository->find($id);
       /* $token=$request->query->get('token');
        if(!$this->isCsrfTokenValid('SPORT_DELETE',$token)){
            throw $this->createAccessDeniedException();
        }*/
        $dm->remove($utilisateur);
        $dm->flush();

        return $this->redirectToRoute("app_utilisateur_liste");


    }

    /**
     * @Route("/liste")
     */
    public function liste(DocumentManager $dm){

        $utilisateurRepository=$dm->getRepository(Utilisateur::class);
        $users=$utilisateurRepository->findBy(
            [],
            ['lastname' =>'ASC']
        );
       // var_dump($users);die;
        return $this->render("utilisateur/liste.html.twig",[
            'users' =>$users
        ]);
    }

}