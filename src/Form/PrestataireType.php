<?php

namespace App\Form;

use App\Entity\Metier;
use App\Entity\Prestataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('metiers', EntityType::class, [
                // looks for choices from this entity
                'class' => Metier::class,
                'by_reference' => false,
                // uses the User.username property as the visible option string
                'choice_label' => 'corps_metier',

                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,

            ])
            ->add("siret")
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
