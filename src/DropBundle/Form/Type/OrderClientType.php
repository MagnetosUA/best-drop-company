<?php

namespace DropBundle\Form\Type;

use DropBundle\Services\GetNewPostAddressFromDB;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class OrderClientType extends AbstractType
{
    private $addressFromDB;

    public function __construct(GetNewPostAddressFromDB $addressFromDB)
    {
        $this->addressFromDB = $addressFromDB;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Фамилия',
                ]
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Имя',
                ]
            ])
            ->add('patronymic', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Отчество',
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Контактный телефон',
                ]
            ])
            ->add('city', ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Укажите город',
                'label' => false,
                'attr' => [
                    'class' => 'js-select2-cities',
                    'name' => 'state',
                ],
                'choice_loader' => new CallbackChoiceLoader(function() {
                    return $this->addressFromDB->getCities();
                }),
            ])
            ->add('warehouse', ChoiceType::class, [
//                'required' => false,
                'attr' => [
                    'class' => 'warehouses',
                ],
                'placeholder' => 'Укажите отделение',
                'label' => false,
                'choices' => [
                ],
            ])
            ->add('full_address', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'full-address',
                    'readonly' => 'readonly',
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'order-comment',
                    'placeholder' => 'Комментарий (цвет, размер, прочие характеристики)',
                ],
            ])
            ->add('product_array', HiddenType::class, [
                'attr' => [
                    'class' => 'hidden-product',
                ],
                'data' => '777',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Сохранить',
                'attr' => [
                    'class' => 'save-order btn btn-success',
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'validation_groups' => false,
        ]);
    }
}

