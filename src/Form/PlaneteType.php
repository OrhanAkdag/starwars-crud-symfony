<?php

namespace App\Form;

use App\Entity\Planete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlaneteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la planète',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('terrain', ChoiceType::class,
                [
                    'label'=> 'Sol de la planète',
                    'expanded'=>true,
                    'choices' => [
                        'Gravier' => 'Gravier',
                        'Sable' => 'Sable',
                        'Inconnu' => 'Inconnu',
                    ]
                ])

            ->add('nbKmTerre')
            ->add('allegiance')
            ->add('description')
            ->add('deteDecouverte',DateType::class, [
                'format'=>'d/M/y'
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Planete::class,
        ]);
    }
}
