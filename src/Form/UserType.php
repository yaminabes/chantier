<?php

namespace App\Form;

use App\Entity\ConducteurTravaux;
use App\Entity\MaitreOuvrage;
use App\Entity\Prestataire;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('username')
            //->add('password')
            ->add('adresse')
            ->add('numTel')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Prestataire' => "ROLE_PRESTATAIRE",
                    'Maitre d\'ouvrage' => "ROLE_CONDUC",
                    'Conducteur de travaux' => "ROLE_MAITRE",

                ],

                'multiple' => true,
                'expanded' => true,
            ])

            ->add('nom')
            ->add('maitreOuvrage', EntityType::class, [
                // looks for choices from this entity
                'class' => MaitreOuvrage::class,
                'by_reference' => false,
                'mapped' => false,
                // uses the User.username property as the visible option string
                'choice_label' => 'prenom',

                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,

            ])
            ->add('conducteurTraveaux',
                EntityType::class, [
                    // looks for choices from this entity
                    'class' => ConducteurTravaux::class,
                    'by_reference' => false,
                    'mapped' => false,
                    // uses the User.username property as the visible option string
                    'choice_label' => 'prenom',

                    // used to render a select box, check boxes or radios
                    'multiple' => false,
                    'expanded' => false,

                ])
            ->add('prestataire', EntityType::class, [
                // looks for choices from this entity
                'class' => Prestataire::class,
                'by_reference' => false,
                'mapped' => false,
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
            'validation_groups' => false,
        ]);
    }
}
