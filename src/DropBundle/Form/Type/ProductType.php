<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('name', TextType::class, [
                'label' => 'Название',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Описание',
                'attr' => [
                    'placeholder' => 'Описание',
                ],
            ])
            ->add('weight', TextType::class, [
                'label' => 'Вес',
                'attr' => [
                    'value' => '1кг'
                ]
            ])
            ->add('cost', TextType::class, [
                'label' => 'Цена',
            ])
            ->add('recomendedCost', TextType::class, [
                'label' => 'Рекомендованная цена',
                ])
            ->add('returnCost', TextType::class, [
                'label' => 'Стоимость возврата',
                'attr' => [
                    'value' => 'Согласно тарифам Новой Почты'
                ]
            ])
            ->add('purveyor', ChoiceType::class, [
                'label' => 'Поставщик',
                'choices' => [
                    'drop1' => 'Drop1',
                    'marina' => 'Marina',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить',
                'attr' => [
                    'class' => 'btn btn-danger'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

