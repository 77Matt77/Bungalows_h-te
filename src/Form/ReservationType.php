<?php

namespace App\Form;

use App\Entity\Commande;
use App\Entity\Formule;
use App\Entity\Option;
use App\Entity\Reservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateArriver')
            ->add('dateDepart')
            ->add('numberOfPeople')
            ->add('commande', EntityType::class, [
                'class' => Commande::class,
'choice_label' => 'id',
            ])
            ->add('formule', EntityType::class, [
                'class' => Formule::class,
'choice_label' => 'id',
            ])
            ->add('optionReservation', EntityType::class, [
                'class' => Option::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
