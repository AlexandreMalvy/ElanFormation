<?php

namespace App\Controller;

use App\Entity\Modul;
use App\Entity\Centre;
use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/activitys")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/", name="activitys_index")
     */
    public function index()
    {
        $centres = $this->getDoctrine()
                ->getRepository(Centre::class);

        $formations = $this->getDoctrine()
                ->getRepository(Formation::class);

        $modules = $this->getDoctrine()
                ->getRepository(Modul::class);

        return $this->render('activity/index.html.twig', [
            'centres' => $centres,
            "formations" => $formations,
            "modules" => $modules
        ]);
    }
    /**
     * @Route("/{id}", name="centre_show", methods="GET")
     */
    public function showCentre(Centre $centre): Response {
        return $this->render('activity/showCentre.html.twig', [
            'centre' => $centre
        ]);
    }
    /**
     * @Route("/{id}", name="formation_show", methods="GET")
     */
    public function showFormation(Formation $formation): Response {
        return $this->render('activity/showFormation.html.twig', [
            'formation' => $formation
        ]);
    }
}
