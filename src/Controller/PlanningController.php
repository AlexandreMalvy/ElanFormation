<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Form\StagiaireType;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/plannings")
 */
class PlanningController extends AbstractController
{
    /**
     * @Route("/", name="plannings_index")
     */
    public function index()
    {
        $sessions = $this->getDoctrine()
            ->getRepository(Session::class)
            ->findAll();

        $stagiaires = $this->getDoctrine()
            ->getRepository(Stagiaire::class)
            ->findAll();

        return $this->render('planning/index.html.twig', [
            'sessions' => $sessions,
            'stagiaires' => $stagiaires
        ]);
    }
    /**
     * @Route("/addstagiaire", name="stagiaire_add")
     * @Route("/{id}/editstagiaire", name="stagiaire_edit")
     */
    public function add_edit_stagiaire(Stagiaire $stagiaire = null, Request $request)
    {
        // si le stagiaire n'existe pas, on instancie un nouveau stagiaire(on est dans le cas d'un ajout) 
        if (!$stagiaire) {
            $stagiaire = new Stagiaire();
        }
        //il faut créer un SalarieType au préalable (php bin/console make:form)
        $form = $this->createForm(StagiaireType::class, $stagiaire);

        $form->handleRequest($request);
        // si on soumet le formulaire et que le form est validé
        if ($form->isSubmitted() && $form->isValid()) {
            //on récuprère les données du formulaire
            $stagiaire = $form->getData();
            //on ajoute le nouveau stagiaire
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stagiaire);
            $entityManager->flush();
            //on redirige vers la liste des stagiaire (stagiaire_list etant le nom de la route)
            return $this->redirectToRoute("plannings_index");
        }
        return $this->render('planning/add_edit_stagiaire.html.twig', [
            'formStagiaire' => $form->createView(),
            'editMode' => $stagiaire->getId() !== null
        ]);
    }
    /**
     * @Route("/add", name="session_add")
     * @Route("/edit/{id}", name="session_edit")
     */
    public function addSession(Session $session = null, Request $request)
    {
        if (!$session) {
            $session = new Session();
        }


        // il faut crée un SessionType au préable (php bin/console make:form)
        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
            $session = $form->getData();
            // on ajoute le nouveau session
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($session);
            $entityManager->flush();
            // on redirige vers la liste des session (Session_list étant le nom de la route qui liste tous les sissions dans PlanningController)
            return $this->redirectToRoute('plannings_index');
        }
        /* on renvoie à la vue correspondante :
        - le formulaire
        - le booléen editMode (si vrai, on est dans le cas d'une éduition sinon on est dans  le cas d'un ajout)
    */
        return $this->render('planning/add_Session.html.twig', [
            'formSession' => $form->createView(),
            'editMode' => $session->getId() !== null
        ]);
    }

    

    /**
     * @Route("/del/{id}", name="session_del")
     */
    public function del_Session(Session $Session)
    {

        $entityManager = $this->getDoctrine()->getManager();


        $entityManager->remove($Session);
        $entityManager->flush();

        return $this->redirectToRoute('plannings_index');
    }

    /**
     * @Route("/session/{id}", name="session_show", methods="GET")
     */
    public function show(Session $Session): Response
    {
        return $this->render('planning/show.html.twig', [
            'Session' => $Session,
        ]);
    }
    /**
     * @Route("/stagiaire/{id}", name="stagiaire_show", methods="GET")
     */
    public function showStagiaire(Stagiaire $stagiaire): Response
    {
        return $this->render('planning/showstagiaire.html.twig', [
            'stagiaire' => $stagiaire,
        ]);
    }

}
