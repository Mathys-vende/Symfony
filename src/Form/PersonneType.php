<?php

namespace App\Form;

use App\Entity\Projet;
use App\Entity\Soiree;
use phpDocumentor\Reflection\Types\ClassString;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('montant', MoneyType::class)
            ->add('Part', IntegerType::class, array('data' => 1))
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
