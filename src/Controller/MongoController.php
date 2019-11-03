<?php

namespace App\Controller;
use App\Document\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ODM\MongoDB\DocumentManager as DocumentManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MongoController extends AbstractController
{
    /**
     * @Route("/mongoTest", methods={"GET"})
     */
    public function mongoTest(DocumentManager $dm)
    {
        $user = new Client();
        $user->setEmail("slimane_kouba@yahoo.fr");
        $user->setFirstname("Linda");
        $user->setLastname("Kouba");
        $user->setPassword(md5("VUACP@ssw0rd"));

        $dm->persist($user);
        $dm->flush();
        return new JsonResponse(array('Status' => 'OK'));
    }


}