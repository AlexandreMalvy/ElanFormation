<?php

namespace App\Controller;

use App\Entity\Centre;
use App\Entity\Module;
use App\Form\CentreType;
use App\Entity\Formation;
use App\Form\FormationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
 * @Route("/activitys")
 */
class ActivityController extends AbstractController
{
    /**
     * @Route("/addcentre", name="centre_add")
     * @Route("/{id}/editcentre", name="centre_edit")
     */
    public function add_edit_centre(Centre $centre = null, Request $request){
        // si le centre n'existe pas, on instancie un nouveau centre(on est dans le cas d'un ajout) 
        if(!$centre){
            $centre = new Centre();
        }
        //il faut créer un SalarieType au préalable (php bin/console make:form)
        $form = $this->createForm(CentreType::class, $centre );

        $form->handleRequest($request);
        // si on soumet le formulaire et que le form est validé
        if($form->isSubmitted() && $form->isValid()){
            //on récuprère les données du formulaire
            $centre = $form->getData();
            //on ajoute le nouveau centre
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($centre);
            $entityManager->flush();
            //on redirige vers la liste des centre (centre_list etant le nom de la route)
            return $this->redirectToRoute("activitys_index");

        }
        return $this->render('activity/add_edit_centre.html.twig', [
            'formCentre' => $form->createView(),
            'editMode'=> $centre->getId() !== null
        ]);
    }
    /**
     * @Route("/addformation", name="formation_add")
     * @Route("/{id}/editformation", name="formation_edit")
     */
    public function add_edit_formation(Formation $formation = null, Request $request){
        // si le formation n'existe pas, on instancie un nouveau formation(on est dans le cas d'un ajout) 
        if(!$formation){
            $formation = new Formation();
        }
        //il faut créer un SalarieType au préalable (php bin/console make:form)
        $form = $this->createForm(FormationType::class, $formation );

        $form->handleRequest($request);
        // si on soumet le formulaire et que le form est validé
        if($form->isSubmitted() && $form->isValid()){
            //on récuprère les données du formulaire
            $formation = $form->getData();
            //on ajoute le nouveau formation
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formation);
            $entityManager->flush();
            //on redirige vers la liste des formation (formation_list etant le nom de la route)
            return $this->redirectToRoute("activitys_index");

        }
        return $this->render('activity/add_edit_formation.html.twig', [
            'formFormation' => $form->createView(),
            'editMode'=> $formation->getId() !== null
        ]);
    }
    /**
     * @Route("/", name="activitys_index")
     */
    public function index()
    {
        $centres = $this->getDoctrine()
                ->getRepository(Centre::class)
                ->findAll();

        $formations = $this->getDoctrine()
                ->getRepository(Formation::class)
                ->findAll();

        $modules = $this->getDoctrine()
                ->getRepository(Module::class);

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
