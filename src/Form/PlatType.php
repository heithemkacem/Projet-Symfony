<?php

namespace App\Form;

use App\Entity\Plat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DecimalType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPlat', TextType::class, [
                'label' => 'Nom du plat',
            ])
            ->add('cout', DecimalType::class, [
                'label' => 'Coût',
                'scale' => 2,
                'empty_data' => 0.0,
            ])
            ->add('nbrCalories', IntegerType::class, [
                'label' => 'Nombre de calories',
                'empty_data' => 0,
            ])
            ->add('ingredients', TextType::class, [
                'label' => 'Ingrédients',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
