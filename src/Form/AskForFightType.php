<?php

namespace App\Form;

use App\Domain\Fight\Fight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AskForFightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('winnersPoints')
            ->add('loosersPoints')
            ->add('date')
            ->add('rules')
            ->add('statut')
            ->add('firstOpponents')
            ->add('secondOpponents')
            ->add('score')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Fight::class,
        ]);
    }
}
