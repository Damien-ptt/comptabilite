<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {   $em = $this->getDoctrine()->getManager();
        $company = $em->getRepository(Company::class)->find(1);
        return $this->render('page/index.html.twig', [
            'company' => $company, 
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('page/login.html.twig', [
          
        ]);
    }
}
