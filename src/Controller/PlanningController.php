<?php

namespace App\Controller;

use App\Entity\Session;
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
    public function index(): Response
    {
        return $this->render('planning/index.html.twig', [
            'controller_name' => 'PlanningController',
        ]);
    }
    /**
     * @Route("/add", name="Session_add")
     * @Route("/edit/{id}", name="Session_edit")
     */
    public function add_Session(Session $Session = null, Request $request)
    {
        if (!$Session) {
            $Session = new Session();
        }


        // il faut crée un salarieType au préable (php bin/console make:form)
        $form = $this->createForm(SalarieType::class, $Session);

        $form->handleRequest($request);
        //si on soumet le formulaire et que le form est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère les données du formulaire
            $Session = $form->getData();
            // on ajoute le nouveau salarié
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Session);
            $entityManager->flush();
            // on redirige vers la liste des salariés (salarie_list étant le nom de la route qui liste tous les salariés dans PlanningController)
            return $this->redirectToRoute('Planning_index');
        }
        /* on renvoie à la vue correspondante :
        - le formulaire
        - le booléen editMode (si vrai, on est dans le cas d'une éduition sinon on est dans  le cas d'un ajout)
    */
        return $this->render('Planning/add_Session.html.twig', [
            'formSession' => $form->createView(),
            'editMode' => $Session->getId() !== null
        ]);
    }

    /**
     * @Route("/del/{id}", name="Session_del")
     */
    public function del_Session(Session $Session)
    {

        $entityManager = $this->getDoctrine()->getManager();


        $entityManager->remove($Session);
        $entityManager->flush();

        return $this->redirectToRoute('Planning_index');
    }

    /**
     * @Route("/{id}", name="Session_show", methods="GET")
     */
    public function show(Session $Session): Response
    {
        return $this->render('Planning/show.html.twig', [
            'Session' => $Session,
        ]);
    }
}
