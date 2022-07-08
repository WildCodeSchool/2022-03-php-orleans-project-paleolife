<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beforeFile', FileType::class, ['label' => 'Photo d\'avant', 'required' => false])
            ->add('afterFile', FileType::class, ['label' => 'Photo d\'après', 'required' => false])
            ->add('dateBefore', DateType::class, [
                'label' => 'Date d\'avant',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false])
            ->add('dateAfter', DateType::class, [
                'label' => 'Date d\'après',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'required' => false])
            ->add('measurementClients', CollectionType::class, ['entry_type' => MeasurementClientType::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
