<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use App\Form\FollowType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FollowController extends AbstractController
{



    /**
     * @Route("/follow", name="follow")
     */
    public function index(Request $request): Response
    {
        $follow  = $request->query->get("userFollow");
        $user_follow = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['name' => $follow]);


      $userin =  $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $userin->addFollower($user_follow);

        $entityManager->flush();





        return $this->redirectToRoute('feed');

    }

}
