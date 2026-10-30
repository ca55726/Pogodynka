<?php

namespace App\Form;

use App\Entity\Measurement;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('temperature', NumberType::class, [
                'label' => 'Temperature (°C)',
                'attr' => [
                    'placeholder' => 'np. 21',
                ],
                'required' => true,
            ])
            ->add('wind', IntegerType::class, [
                'label' => 'Windness (km/h)',
                'attr' => [
                    'placeholder' => 'np. 15',
                    'min' => 0,
                ],
            ])
            ->add('humidity', IntegerType::class, [
                'label' => 'Humidity (%)',
                'attr' => [
                    'placeholder' => 'np. 45',
                    'min' => 0,
                    'max' => 100,
                ],
            ])
            ->add('precipitation', IntegerType::class, [
                'label' => 'Precipitation (mm)',
                'attr' => [
                    'placeholder' => 'np. 12',
                    'min' => 0,
                ],
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => function (Place $place) {
                    return $place->getCity() . ', ' . $place->getCountry();
                },
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
