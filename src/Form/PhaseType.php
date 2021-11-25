<?php

namespace App\Form;

use App\Entity\Chantier;
use App\Entity\Phase;
use App\Entity\Tache;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomPhase')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('taches', EntityType::class,
            [
                'by_reference' => false,
                'class' => Tache::class,
                'multiple' => true,
                'expanded' => true,
            ]
                )
            ->add('chantier', EntityType::class,
                [
                    'by_reference' => false,
                    'class' => Chantier::class,
                    'multiple' => true,
                    'expanded' => true,
                ]
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Phase::class,
        ]);
    }
}
