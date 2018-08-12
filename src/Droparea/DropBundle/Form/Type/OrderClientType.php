<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Ord;
use Droparea\DropBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, [
                'label' => 'Фамилия',])
            ->add('name', TextType::class, [
                'label' => 'Имя',
            ])
            ->add('patronymic', TextType::class, [
                'label' => 'Отчество'
            ])
            ->add('phone', TelType::class, [
                'label' => 'Контактный телефон',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ord::class,
        ]);
    }
}

