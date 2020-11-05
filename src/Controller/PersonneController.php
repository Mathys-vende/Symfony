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
     * @Route("/soiree/{idSoiree}", name="Soiree")
     */
    public function index(Soiree $idSoiree, Request $request)
    {
        $repo=$this->getDoctrine()->getRepository(Soiree::class);
        $soiree=$repo->find($idSoiree);


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
        }



        $personne=$soiree->getIdProjet();

        return $this->render('soiree/index.html.twig', [
            'soiree'=>$soiree,
            'personne'=>$personne,
            "formulaire" => $form->createView()
        ]);
    }
}
