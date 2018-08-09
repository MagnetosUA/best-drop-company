<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('productCode', TextType::class, [
            'label' => 'Код',])
        ->add('country', TextType::class, [
            'label' => 'Страна',
            'attr' => [
                'value' => 'Україна',
                'class' => 'form-control',
            ]
        ])
        ->add('category', ChoiceType::class, [
            'label' => 'Категория',
            'choices' => [
                'Электроника' => 'electronica',
                'Разное' => 'other',
                'Товары для дома' => 'for-house',
            ]
        ])
        ->add('image', FileType::class, [
            'label' => 'Фото',
        ])
        ->add('name', TextType::class, [
            'label' => 'Название',
        ])
        ->add('weight', TextType::class, [
            'label' => 'Вес',
        ])
        ->add('cost', TextType::class, [
            'label' => 'Цена',
        ])
        ->add('recomendedCost', TextType::class, [
            'label' => 'Рекомендованная цена',
        ])
        ->add('returnCost', TextType::class, [
            'label' => 'Стоимость возврата',
        ])
        ->add('valuta', TextType::class, [
            'label' => 'Валюта',
            'attr' => [
                'value' => 'Гривня'
            ]
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Добавить'
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

