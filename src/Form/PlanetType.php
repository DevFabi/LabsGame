<?php

namespace App\Form;

use App\Application\Command\Planet\AddPlanetCommand;
use App\Domain\Model\Planet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddPlanetCommand::class,
            'allow_extra_fields' => true,
            'csrf_protection'    => false,
            ]
        );
    }
}
