<?php

namespace App\Controller;

use App\Form\TweetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddTweetController extends AbstractController
{
    /**
     * @Route("/add/tweet", name="add_tweet")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(TweetType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tweet = $form->getData();
            $tweet->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tweet);
            $entityManager->flush();
            //$this->redirectToRoute();

            //flashbag
        }
        return $this->redirectToRoute("feed");

    }
}
