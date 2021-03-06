<?php

namespace DropBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('_username', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                ]
            ])
            ->add('_password', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Пароль',
                    'class' => 'password',
                ]
            ]);
    }
}

