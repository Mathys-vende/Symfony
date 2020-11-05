<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Soiree;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutPersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('montant')
            ->add('Part')
            ->add("ok", SubmitType::class, ["label"=>"Enregistrer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'idSoiree' => -1, // ne pas oublier de mettre une valeur par défaut
            'data_class' => Projet::class,
        ]);
    }

}
