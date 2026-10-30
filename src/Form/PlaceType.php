<?php

namespace App\Form;

use App\Entity\Place;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', null, [
                'attr' => [
                    'placeholder' => 'Enter city name'
                ],
                'required' => true
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'pl',
                    'Germany' => 'de',
                    'France' => 'fr',
                    'Italy' => 'it',
                ],
                'required' => true,
            ])
            ->add('latitude', NumberType::class, [
                'scale' => 7,
                'attr' => [
                    'step' => 'any',
                    'placeholder' => 'Enter latitude (e.g. 67.0000000)',
                    'max' => 90,
                    'min' => -90,
                ],
            ])
            ->add('longitude', NumberType::class, [
                'scale' => 7,
                'attr' => [
                    'step' => 'any',
                    'placeholder' => 'Enter longitude (e.g. 50.3497875)',
                    'max' => 90,
                    'min' => -90,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Place::class,
        ]);
    }
}
