<?php

namespace App\Form;

use App\Entity\Caisse;
use App\Entity\Consultation;
use App\Entity\Facturation;
use App\Entity\ModePaiement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FacturationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('modePaiement')
            ->add('caisse')
            ->add('consultation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Facturation::class,
        ]);
    }
}
