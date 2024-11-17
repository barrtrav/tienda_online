<?php

namespace App\Form;

use App\Entity\BagReception;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BagReception1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bagCode')
            ->add('receptionDate')
            ->add('responsable')
            ->add('qrCode')
            ->add('distributionCenter')
            ->add('bag')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BagReception::class,
        ]);
    }
}
