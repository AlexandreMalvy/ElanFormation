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
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        // $sessions = $this->getDoctrine()
        //     ->getRepository(Session::class)
        //     ->findBy([], ["dateDebut" => "ASC"],3);
        $sessions = $this->getDoctrine()
                ->getManager()
                ->createQuery("SELECT s FROM App\Entity\Session s WHERE s.dateDebut > CURRENT_DATE() ORDER
                BY s.dateDebut ASC")
                ->setMaxResults(3)
                ->getResult();


        return $this->render('home/index.html.twig', [
            'sessions' => $sessions
        ]);
    }
}
