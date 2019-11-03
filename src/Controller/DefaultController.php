<?php
/**
 * Created by PhpStorm.
 * Client: slima
 * Date: 03/12/2018
 * Time: 15:49
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 * @Route("/")
 */
class DefaultController extends  AbstractController
{
    /**
     * @Route("/home")
     */
    public function home(){

        return $this->render("/home.html.twig");

    }

}