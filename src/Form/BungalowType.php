<?php

namespace App\Form;

use App\Entity\Bungalow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class BungalowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class)
        ->add('description', TextType::class)
        ->add('capaciter', IntegerType::class)
        ->add('price_per_night', IntegerType::class)
        ->add('activation', CheckboxType::class);

//             ->add('reservation', EntityType::class, [
//                 'class' => Reservation::class,
// 'choice_label' => 'id',
//             ])
//             ->add('Calendrier', EntityType::class, [
//                 'class' => Calendrier::class,
// 'choice_label' => 'id',
//             ])
            // ->add('activation', CheckboxType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bungalow::class,
        ]);
    }
}
