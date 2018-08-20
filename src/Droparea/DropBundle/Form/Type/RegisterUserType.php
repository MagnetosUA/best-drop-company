<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
                'attr' => [
                    'placeholder' => 'ФИО',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email',
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Контактный номер телефона',
                    'class' => 'telephone',
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'attr' => ['placeholder' => 'Пароль'],
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => ['placeholder' => 'Повторите пароль'],
                    'label' => false,
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Регистрация',
                'attr' => [
                    'class' => 'btn btn-info',
                ],
            ]);
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => User::class,
//        ]);
//    }
}

