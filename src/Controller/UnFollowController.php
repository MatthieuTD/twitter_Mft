<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnFollowController extends AbstractController
{
    /**
     * @Route("/un/follow", name="un_follow")
     */
    public function index(Request $request): Response
    { $follow  = $request->query->get("userFollow");
        $user_follow = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['name' => $follow]);


        $userin =  $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        $userin->removeFollower($user_follow);

        $entityManager->flush();





        return $this->redirectToRoute('feed');
    }
}
