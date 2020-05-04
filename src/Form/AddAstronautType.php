<?php


namespace App\Form;


use App\Application\Command\Astronaut\AddAstronautCommand;
use App\Domain\Model\Astronaut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAstronautType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('password')
            ->add('apiToken')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddAstronautCommand::class,
            'csrf_protection' => false,
            "allow_extra_fields" => true
        ]);
    }
}