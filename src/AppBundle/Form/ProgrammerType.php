<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgrammerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname', TextType::class)
            // ->add('avatarNumber', NumberType::class)
            ->add('avatarNumber', ChoiceType::class, [
                'choices' => [
                    'Girl (green)' => 1,
                    'Boy' => 2,
                    'Cat' => 3,
                    'Boy with Hat' => 4,
                    'Happy Robot' => 5,
                    'Girl (purple)' => 6
                ]
            ])
            ->add('tagLine', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Programmer',
            'csrf_protection' => false
        ]);
    }

    public function getName()
    {
        return 'programmer';
    }
}
