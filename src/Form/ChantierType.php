<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Phase;
use App\Entity\Tache;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('dateFin')
            ->add('adresse')
            ->add('phases',EntityType::class,
            [
                'by_reference' => false,
                'mapped' => false,
                'class' => Phase::class,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('conducteur_travaux')
            ->add('maitre_ouvrage')
            ->add('type_batiment')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chantier::class,
        ]);
    }
}
