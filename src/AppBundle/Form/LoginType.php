<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Login')
            ))
            ->add('password', PasswordType::class, array(
                'label' => false,
                'attr' => array('placeholder' => 'Email')
            ))
            ->add('save', SubmitType::class, array(
                "label" => "login"
            ));
    }
}