<?php

namespace App\Form;

use App\Entity\NutritionMeal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NutritionMealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mealName', TextType::class, [
                'label' => 'Nom du repas',
                'attr' => [
                    'placeholder' => 'Petit déjeuner',
                ]
            ])
            ->add('proteins', IntegerType::class, [
                'label' => 'Quantité de protéines (g)',
                'attr' => [
                    'placeholder' => '300',
                    'min' => 0
                ]
            ])
            ->add('lipids', IntegerType::class, [
                'label' => 'Quantité de lipides (g)',
                'attr' => [
                    'placeholder' => '250',
                    'min' => 0
                ]
            ])
            ->add('carbohydrate', IntegerType::class, [
                'label' => 'Quantité de glucides (g)',
                'attr' => [
                    'placeholder' => '200',
                    'min' => 0
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NutritionMeal::class,
        ]);
    }
}
