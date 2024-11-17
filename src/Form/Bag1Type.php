<?php

namespace App\Form;

use App\Entity\Bag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Bag1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('creationDate')
            ->add('order')
            ->add('products')
            ->add('distributionCenter')
            ->add('bagReception')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bag::class,
        ]);
    }
}
