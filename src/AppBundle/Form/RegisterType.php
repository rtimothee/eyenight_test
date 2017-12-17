<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Email')
            ))
            ->add('login', TextType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Login')
            ))
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_name'      => "password",
                'second_name'     => "confirm",
                'first_options'  => array(
                    'label' => false,
                    'attr' => array('placeholder' => 'Enter password')
                ),
                'second_options' => array(
                    'label' => false,
                    'attr' => array('placeholder' => 'Retype password')
                ),
            ))
            ->add('save', SubmitType::class);
    }
}