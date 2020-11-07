<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Soiree;
use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne/ajouter/{idSoiree}", name="ajouter_personne")
     */
    public function index(Soiree $idSoiree, Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree = $repo->find($idSoiree);


        $personne = new Projet();
        $form = $this->createForm(PersonneType::class, $personne, [
        'idSoiree' => $idSoiree // valeur a envoyer
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $personne->setIdSoiree($idSoiree);
            $em->persist($personne);
            $em->flush();

            //return $this->redirectToRoute("", ["id"=>$chaton->getCategorie()->getId()]);
        }

        $personne=$soiree->getIdProjet();

        return $this->render('personne/index_ajouter.html.twig', [
            'soiree'=>$soiree,
            'personne'=>$personne,
            "formulaire" => $form->createView()
        ]);
    }

    /**
     * @Route("/chatons/modifier/{id}/{idSoiree}", name="modifier_personne")
     */

    public function modifier($id, Soiree $idSoiree, Request $request){

        $repo = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree = $repo->find($idSoiree);

        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $personne = $repo->find($id);

        $form = $this->createForm(PersonneType::class, $personne, [
            'idSoiree' => $idSoiree // valeur a envoyer
        ]);
        //gérer le retour du POST

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //récupérer l'entity manager (objet qui gère la connection a la BDD)
            $em = $this->getDoctrine()->getManager();

            //je dis au manager que je veux gardé l'objet en BDD
            $em->persist($personne);

            //je déclenche l'insert
            $em->flush();

            // je vais à la liste des catégories
            return $this->redirectToRoute("ajouter_personne", ["idSoiree"=>$personne->getIdSoiree()->getId()]);
        }

        return $this->render('personne/modifier.html.twig', [
            'formulaire' => $form->createView(),
            "personne"=>$personne,
            "soiree" => $soiree
        ]);
    }


    /**
     * @Route("/chatons/supprimer/{id}/{idSoiree}", name="supprimer_personne")
     */

    public function supprimer($id, Soiree $idSoiree, Request $request){

        $repo = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree = $repo->find($idSoiree);

        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $personne = $repo->find($id);

        $form = $this->createForm(PersonneType::class, $personne, [
            'idSoiree' => $idSoiree // valeur a envoyer
        ]);
        //gérer le retour du POST

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //récupérer l'entity manager (objet qui gère la connection a la BDD)
            $em = $this->getDoctrine()->getManager();

            //je dis au manager que je veux gardé l'objet en BDD
            $em->remove($personne);

            //je déclenche l'insert
            $em->flush();

            // je vais à la liste des catégories
            return $this->redirectToRoute("ajouter_personne", ["idSoiree"=>$personne->getIdSoiree()->getId()]);
        }

        return $this->render('personne/supprimer.html.twig', [
            'formulaire' => $form->createView(),
            "personne"=>$personne,
            "soiree" => $soiree
        ]);
    }
}
