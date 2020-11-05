<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Soiree;
use App\Form\AjoutPersonneType;
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
        $form = $this->createForm(AjoutPersonneType::class, $personne, [
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

        return $this->render('personne/ajouter.html.twig', [
            'soiree'=>$soiree,
            'personne'=>$personne,
            "formulaire" => $form->createView()
        ]);
    }
}
