<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use App\Form\FollowType;
use App\Form\TweetType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedController extends AbstractController
{
    /**
     * @Route("/feed", name="feed")
     */
    public function index (Request $request): Response
    {
        $repository = $this->getDoctrine()->getRepository(Tweet::class);

        $tweet = new Tweet();
        $user = $this->getUser();
        $follow_users =  $this->getUser()->getFollower();

        $tweets =  $repository->findAll();
        $form = $this->createForm(TweetType::class);
        $form->handleRequest($request);

        $retweet = $this->getUser()->getReTweets();



        return $this->render('feed/index.html.twig', [
            'form'            => $form->createView(),
            'controller_name' => 'FeedController',
            'tweets' => $tweets,
            'follow_users' => $follow_users,
            'retweet' => $retweet,
            'userP'=> $user,
        ]);
    }
}
