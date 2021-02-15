<?php

namespace App\Controller;

use App\Entity\Tweet;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteTweetController extends AbstractController
{
    /**
     * @Route("/delete/tweet", name="delete_tweet")
     */
    public function index(Request $request): Response
    {
        $supTweet = $request->query->get("tweet");

        $msg = $this->getDoctrine()
            ->getRepository(Tweet::class)
            ->findById($supTweet);
        $entityManager = $this->getDoctrine()->getManager();
        $tweet = $entityManager->getRepository(Tweet::class)->find($supTweet);



        $entityManager->remove($tweet);
        $entityManager->flush();

        return $this->redirectToRoute('account');


    }
}
