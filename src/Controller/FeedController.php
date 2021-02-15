<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
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
    public function index(Request $request): Response
    {
        $tweet = new Tweet();



        $form = $this->createForm(TweetType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) {
             $tweet = $form->getData();
            $tweet->setUser($this->getUser());
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($tweet);
             $entityManager->flush();
             //$this->redirectToRoute();
            //flashbag
        }
        return $this->render('feed/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'FeedController',
        ]);
    }
}
