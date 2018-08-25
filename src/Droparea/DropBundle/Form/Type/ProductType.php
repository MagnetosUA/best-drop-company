<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
        ->add('category', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'name',
            'multiple' => false,
            'label' => 'Категория'
        ])
        ->add('images', FileType::class, [
            'label' => 'Фото',
            'multiple' => true,
        ])
        ->add('description', TextType::class, [
            'label' => 'Описание',
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

