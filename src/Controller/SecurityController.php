<?php
/**
 * Created by PhpStorm.
 * User: slima
 * Date: 28/11/2018
 * Time: 11:14
 */

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @Route("/connexion")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     * @param AuthenticationUtils $utils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $utils){

        return $this->render('security/login.html.twig',[
            'error' => $utils->getLastAuthenticationError(),
            'last_username' => $utils->getLastUsername(),
        ]);
    }

}