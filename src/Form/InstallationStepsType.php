<?php

namespace App\Form;

use App\Entity\InstallationSteps;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstallationStepsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('create_at')
            ->add('update_at')
            ->add('is_admin')
            ->add('name_event')
            ->add('is_logo')
            ->add('is_base')
            ->add('is_config_mailer')
            ->add('is_metabase')
            ->add('is_available')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InstallationSteps::class,
        ]);
    }
}
