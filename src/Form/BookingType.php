<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Guest;
use App\Entity\BookingType as BType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('guest', EntityType::class, array(
            'class' => RType::class,
            'choice_label' => ''
        ))
        ->add('bookingType', EntityType::class, array(
            'class' => RType::class,
            'choice_label' => 'type'
        ))
        ->add('arrival', DateType::class)
        ->add('depature', DateType::class)
        ->add('expirationDate', DateType::class)
        ->add('send', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
