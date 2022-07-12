<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('globalName', TextType::class, [
                'label' => 'Objectif global'
            ])
            ->add('monthName', TextType::class, [
                'label' => 'Objectif du mois'
            ])
            ->add('objectiveNutrition', TextType::class, [
                'label' => 'Objectif de la nutrition'
            ])
            ->add('energyExpenditure', IntegerType::class, [
                'label' => 'Dépense énergétique',
                'help' => 'Saisir une valeur en kcal'
            ])
            ->add('water', IntegerType::class, [
                'label' => 'Hydratation journalière',
                'help' => 'Saisir une valeur en litre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
