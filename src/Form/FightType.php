<?php

namespace App\Form;

use App\Application\Command\Fight\AskForFightCommand;
use App\Entity\Fight;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amountGain')
            ->add('amountLoss')
            ->add('date',DateType::class,
            [
                'widget'        => 'single_text',
                'format'        => 'yyyy-MM-dd',
                'property_path' => 'date',
            ])
            ->add('rules')
            ->add('firstOpponents', CollectionType::class,
                ['allow_add' => true])
            ->add('secondOpponents', CollectionType::class,
                ['allow_add' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AskForFightCommand::class,
            'csrf_protection' => false,
            "allow_extra_fields" => true
        ]);
    }
}
