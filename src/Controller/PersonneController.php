<?php

namespace App\Controller;

use App\Entity\Projet;
use App\Entity\Soiree;
use App\Form\PersonneSupprimerType;
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
        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $personne->setIdSoiree($idSoiree);
            $em->persist($personne);
            $em->flush();
            unset($personne);
            unset($repo);
            unset($form);
            $personne = new Projet();
            $form = $this->createForm(PersonneType::class, $personne);
        }

        $personne=$soiree->getIdProjet();

        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $total_montant = $repo->createQueryBuilder('test')
            ->select('SUM(test.montant) as total_montant')
            ->where('test.idSoiree = :id')
            ->setParameter('id', $idSoiree)
            ->getQuery()
            ->getSingleScalarResult();

        $total_part = $repo->createQueryBuilder('test')
            ->select('SUM(test.Part) as total_part')
            ->where('test.idSoiree = :id')
            ->setParameter('id', $idSoiree)
            ->getQuery()
            ->getSingleScalarResult();

        if ( $total_part != 0){
            $une_part = round($total_montant / $total_part, 2);
        }else{
            $une_part = '';
        }


        foreach ($personne as $p){
            if ($p->getMontant() > $une_part){
                $p->setArecevoir($p->getMontant() - ( $une_part * $p->getPart()));
            }elseif ($p->getMontant() < $une_part){
                $p->setApayer(( $une_part * $p->getPart() - $p->getMontant()));
            }
        }


        return $this->render('personne/index_ajouter.html.twig', [
            'soiree'=>$soiree,
            'personne'=>$personne,
            'total_montant' => $total_montant,
            'total_part' => $total_part,
            'une_part' => $une_part,
            "formulaire" => $form->createView()
        ]);
    }

    /**
     * @Route("/personne/modifier/{id}/{idSoiree}", name="modifier_personne")
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
     * @Route("/personne/supprimer/{id}/{idSoiree}", name="supprimer_personne")
     */

    public function supprimer($id, Soiree $idSoiree, Request $request){

        $repo = $this->getDoctrine()->getRepository(Soiree::class);
        $soiree = $repo->find($idSoiree);

        $repo = $this->getDoctrine()->getRepository(Projet::class);
        $personne = $repo->find($id);

        $form = $this->createForm(PersonneSupprimerType::class, $personne, [
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
