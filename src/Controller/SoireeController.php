<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Soiree;
use App\Form\SoireeSupprimerType;
use App\Form\SoireeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoireeController extends AbstractController
{
    /**
     * @Route("/Soiree", name="home_soiree")
     */
    public function index()
    {

        $repository = $this->getDoctrine()->getRepository(Soiree::class);
        //je lis la BDD
        $soiree=$repository->findAll();

        return $this->render('soiree/index.html.twig', [
            'soiree' => $soiree,
        ]);
    }

    /**
     * @Route("/Soiree/ajouter",name="ajouter_soiree")
     */
    public function AjouterSoiree(Request $request)
    {

        $soiree = new Soiree();
        $form = $this->createForm(SoireeType::class, $soiree);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($soiree);
            $em->flush();
            return $this->redirectToRoute("home_soiree", ["idSoiree"=>$soiree->getId()]);
        }
        return $this->render("soiree/ajouter.html.twig", [
            "formulaire" => $form->createView(),

        ]);
    }

    /**
     * @Route("/Soiree/modifier/{id}", name="modifier_soiree")
     */

    public function modifier($id, Request $request){
        //récuperer la catégorie en BDD
        $repository = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree=$repository->find($id);


        //créer le formulaire
        $form=$this->createForm(SoireeType::class, $soiree);

        //gérer le retour du POST

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //récupérer l'entity manager (objet qui gère la connection a la BDD)
            $em = $this->getDoctrine()->getManager();

            //je dis au manager que je veux gardé l'objet en BDD
            $em->persist($soiree);

            //je déclenche l'insert
            $em->flush();

            // je vais à la liste des catégories
            return $this->redirectToRoute("home_soiree");
        }

        return $this->render('soiree/modifier.html.twig', [
            'formulaire' => $form->createView(),
            "soiree"=>$soiree,
        ]);
    }

    /**
     * @Route("/Soiree/supprimer/{id}", name="supprimer_soiree")
     */

    public function supprimer(Soiree $id, Request $request){
        //récuperer la catégorie en BDD
        $repository = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree=$repository->find($id);

        //créer le formulaire
        $form=$this->createForm(SoireeSupprimerType::class, $soiree);

        //gérer le retour du POST

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //récupérer l'entity manager (objet qui gère la connection a la BDD)
            $em = $this->getDoctrine()->getManager();

            //je dis au manager que je veux gardé l'objet en BDD
            $em->remove($soiree);

            //je déclenche l'insert
            $em->flush();

            // je vais à la liste des catégories
            return $this->redirectToRoute("home_soiree");
        }

        return $this->render('soiree/supprimer.html.twig', [
            'formulaire' => $form->createView(),
            "soiree"=>$soiree
        ]);
    }




}
