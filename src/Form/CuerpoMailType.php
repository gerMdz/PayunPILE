<?php

namespace App\Form;

use App\Entity\CuerpoMail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CuerpoMailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texto')
            ->add('isActivo', ChoiceType::class, [
                'required' => true,
                'label' => false,
                'help' => 'Está activo?',
                'choices'  => [
                    'Si' => true,
                    'No' => false,
                ],
                'preferred_choices'=>[true],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('isHability', ChoiceType::class, [
                'required' => true,
                'label' => false,
                'help' => 'Habilitada?',
                'choices'  => [
                    'Si' => true,
                    'No' => false,
                ],
                'preferred_choices'=>[true],
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('textofirma')
            ->add('nombre')
            ->add('identificador')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CuerpoMail::class,
        ]);
    }
}
