<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'data' => 'ФИО',
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'data' => 'Email',
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'data' => 'Контактный номер телефона',
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'data' => 'Пароль',
            ])
            ->add('confirm-password', PasswordType::class, [
                'label' => false,
                'data' => 'Подтверждение пароля',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Регистрация'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

