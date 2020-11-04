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
     * @Route("/Soiree", name="HomeSoiree")
     */
    public function index(): Response
    {
        return $this->render('soiree/index.html.twig', [
            'controller_name' => 'SoireeController',
        ]);
    }


    /**
     * @Route("/Soiree/ajouter",name="AjouterSoiree")
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
            return $this->redirectToRoute("Soiree", ["idSoiree"=>$soiree->getId()]);
        }
        return $this->render("soiree/AjouterSoiree.html.twig", [
            "formulaire" => $form->createView(),

        ]);
    }




}
