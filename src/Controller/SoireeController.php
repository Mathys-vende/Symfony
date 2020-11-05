<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Soiree;
use App\Form\CreationSoireeType;
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
        $form = $this->createForm(CreationSoireeType::class, $soiree);
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




}
