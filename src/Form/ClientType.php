<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('energyExpenditure', NumberType::class, [
                'label' => 'Dépense énergétique'
            ])
            ->add('water', NumberType::class, [
                'label' => 'hydratation journalière'
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
