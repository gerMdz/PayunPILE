<?php

namespace App\Form;

use App\Entity\CuerpoMail;
use App\Entity\GroupCelebration;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupCelebrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActivo', CheckboxType::class, [
        'required' => false,
        'label' => 'Activo?',
        'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
        'attr' => [
            'class' => 'form-check-input ',
        ],
    ])
            ->add('baseCss')
            ->add('btonCss')
            ->add('imageBg')
//            ->add('celebraciones')
            ->add('imageFilename')
            ->add('title')
            ->add('orden')
            ->add('mail', EntityType::class, [
                'class'=> CuerpoMail::class,
                'placeholder' => 'Seleccione mail',
                'attr'=>[
                    'class' => 'select2-enable',
                    'placeholder' => 'Seleccione mail'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupCelebration::class,
        ]);
    }
}
