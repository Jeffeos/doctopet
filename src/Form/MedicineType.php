<?php

namespace App\Form;

use App\Entity\Medicine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => "Medicine name",
                'attr' => [
                    'placeholder' => 'ex: Doliprane 500',
                ],
            ])
            ->add('morning')
            ->add('noon')
            ->add('evening')
            ->add('quantity', null, [
                'label' => "Number of pills per intake",
                'attr' => [
                    'placeholder' => 'ex: 2',
                ],
            ])
            ->add('numberOfDays', null, [
                'label' => "Days of treatment",
                'attr' => [
                    'placeholder' => 'ex: 7',
                ],
            ])
            ->add('user', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicine::class,
        ]);
    }
}
