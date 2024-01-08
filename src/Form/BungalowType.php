<?php

namespace App\Form;

use App\Entity\Bungalow;
use App\Entity\Calendrier;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BungalowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('capaciter')
            ->add('prixParNuit')
            ->add('reservation', EntityType::class, [
                'class' => Reservation::class,
'choice_label' => 'id',
            ])
            ->add('Calendrier', EntityType::class, [
                'class' => Calendrier::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bungalow::class,
        ]);
    }
}
