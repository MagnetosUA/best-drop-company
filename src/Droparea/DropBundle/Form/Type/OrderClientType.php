<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Ord;
use Droparea\DropBundle\Services\FetchNewPostAddress;
use Droparea\DropBundle\Services\GetNewPostAddressFromDB;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

class OrderClientType extends AbstractType
{
    private $addressFromDB;
    private $newPostAddress;

    public function __construct(GetNewPostAddressFromDB $addressFromDB, FetchNewPostAddress $newPostAddress)
    {
        $this->addressFromDB = $addressFromDB;
        $this->newPostAddress = $newPostAddress;
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
                'placeholder' => 'Укажите город',
                'label' => false,
                'attr' => [
                    'class' => 'js-example-basic-single',
                    'name' => 'state',
                ],
                'choice_loader' => new CallbackChoiceLoader(function() {
                    return $this->addressFromDB->getCities();
                }),
            ])
            ->add('warehouse', ChoiceType::class, [
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
//                'data' => null,
//                'data' => 'Default value'
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
//            'data_class' => Ord::class,
            'validation_groups' => false,
        ]);
    }
}

