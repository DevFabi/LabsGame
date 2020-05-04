<?php

namespace App\Form;

use App\Application\Command\Score\WriteScoreFightCommand;
use App\Entity\Score;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fight')
            ->add('endDateTime',DateType::class,
            [
                'widget'        => 'single_text',
                'format'        => 'yyyy-MM-dd',
                'property_path' => 'endDateTime',
            ])
            ->add('winners', CollectionType::class,
            ['allow_add' => true])
            ->add('loosers', CollectionType::class,
            ['allow_add' => true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WriteScoreFightCommand::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true
        ]);
    }
}
