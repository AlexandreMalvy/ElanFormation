<?php

namespace App\Controller;

use App\Entity\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     */
    public function index(): Response
    {
        $sessions = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findBy([], ["dateDebut" => "ASC"],3);

        return $this->render('home/index.html.twig', [
            'sessions' => $sessions
        ]);
    }
}
