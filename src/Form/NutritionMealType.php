<?php

namespace App\Form;

use App\Entity\NutritionMeal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NutritionMealType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mealName', TextType::class, [
                'label' => 'Nom du repas'
            ])
            ->add('proteins', NumberType::class, [
                'label' => 'Quantité de protéines'
            ])
            ->add('lipids', NumberType::class, [
                'label' => 'Quantité de lipides'
            ])
            ->add('carbohydrate', NumberType::class, [
                'label' => 'Quantité de glucides'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NutritionMeal::class,
        ]);
    }
}
