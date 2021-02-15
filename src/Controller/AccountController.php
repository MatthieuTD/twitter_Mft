<?php

namespace App\Controller;

use App\Form\FollowType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */



    public function index(Request $request): Response
    {

        $form = $this->createForm(FollowType::class);

        $form->handleRequest($request);


     if ($form->isSubmitted()&& $form->isValid()){
     $fol =   $form->get("follows")->getData();

         return $this->render('account/index.html.twig', [
             'form' => $form->createView(),
             'follow' => $fol,
         ]);
     }else{
         $fol = "pas de nouveau FOLLOW";
     }

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'follow' => $fol,
        ]);
        /**
        return $this->render('account/index.html.twig', [
        'controller_name' => 'AccountController',
        ]);
         */

    }
}
