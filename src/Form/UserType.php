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
                    'Maitre d\'ouvrage' => "ROLE_MAITRE",
                    'Prestataire' => "ROLE_PRESTATAIRE",
                    'Conducteur de travaux' => "ROLE_CONDUC",
                ],

                'multiple' => true,
                'expanded' => true,
            ])

            ->add('nom')
            ->add('maitreOuvrage')
            ->add('conducteurTraveaux')
            ->add('prestataire')
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
