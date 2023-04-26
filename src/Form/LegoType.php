<?php

namespace App\Form;

use App\Entity\Lego;
use App\Entity\LegoUserRelation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class LegoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('ref')
            ->add('test', CheckboxType::class, [
                'data' => $options['isChecked'],
                'required' => false,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lego::class,
            'isChecked' => false,
        ]); 
    }
}
