<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReTweetController extends AbstractController
{
    /**
     * @Route("/re/tweet", name="re_tweet")
     */
    public function index(Request $request): Response
    {
        $userReTweet  = $request->query->get("userRetweet");
        $tweet = $request->query->get("tweetId");

        $user_re = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['name' => $userReTweet]);
        $tweet_re = $this->getDoctrine()
            ->getRepository(Tweet::class)
            ->findOneBy(['id' => $tweet]);



        $entityManager = $this->getDoctrine()->getManager();

        $tweet_re->addReTweet($user_re);


        $entityManager->flush();





        return $this->redirectToRoute('feed');

    }
}
