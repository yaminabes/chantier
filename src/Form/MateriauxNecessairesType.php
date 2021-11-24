<?php

namespace App\Form;

use App\Entity\MateriauxNecessaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MateriauxNecessairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite_prevue')
            ->add('quantite_utilisee')
            ->add('materiaux')
            ->add('tache')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MateriauxNecessaires::class,
        ]);
    }
}
