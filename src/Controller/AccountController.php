<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Form\FollowType;
use App\Entity\User;
use App\Form\RmTweetType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */



    public function index(Request $request): Response
    {
        $supTweet = $request->query->get("tweet");

        if (isset($supTweet)){

            $msg = $this->getDoctrine()
                ->getRepository(Tweet::class)
                ->findById($supTweet);
            $entityManager = $this->getDoctrine()->getManager();
            $product = $entityManager->getRepository(Tweet::class)->find($supTweet);



            $entityManager->remove($product);
            $entityManager->flush();
        }

        $tweets =  $this->getUser()->getTweets();


        return $this->render('account/index.html.twig', [
            'tweets' => $tweets,

        ]);


    }
}
