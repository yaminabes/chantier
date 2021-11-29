<?php

namespace App\Form;

use App\Entity\Phase;
use App\Entity\Tache;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Tache1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_tache')
            ->add('tarif_prestation')
            ->add('prestataire')
            ->add('metier')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('duree')
            ->add('phase', EntityType::class,
            [
                'class' => Phase::class,
                'choice_label' => 'nomPhase',
                'by_reference' => false,
                'multiple'=> true,
            ])
            ->add('tache_dependante', EntityType::class,
                [
                    'class' => Tache::class,
                    'by_reference' => false,
                    'multiple'=> true,
                ]
            )

            ->add('statut')
            ->add('stockTacheUtilises')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
