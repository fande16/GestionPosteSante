<?php

namespace App\Form;

use App\Entity\LignePrescription;
use App\Entity\Prescription;
use App\Entity\Stock;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignePrescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Libelle')
            ->add('quantite')
            ->add('posologie')
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('prescription')
            ->add('stock')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LignePrescription::class,
        ]);
    }
}
