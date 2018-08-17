<?php

namespace Droparea\DropBundle\Form\Type;

use Droparea\DropBundle\Entity\Ord;
use Droparea\DropBundle\Services\FetchNewPostAddress;
use Droparea\DropBundle\Services\GetNewPostAddressFromDB;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
                'label' => ' ',
                'data' => 'Фамилия',
            ])
            ->add('name', TextType::class, [
                'label' => ' ',
                'data' => 'Имя',
            ])
            ->add('patronymic', TextType::class, [
                'label' => ' ',
                'data' => 'Отчество',
            ])
            ->add('phone', TelType::class, [
                'label' => ' ',
                'data' => 'Контактный телефон',
            ])
            ->add('city', ChoiceType::class, [
                'placeholder' => 'Укажите город',
                'label' => ' ',
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
                'label' => ' ',
                'choices' => [
                ],
            ])
            ->add('full_address', TextareaType::class, [
                'label' => ' ',
                'attr' => [
                    'class' => 'full-address',
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Добавить',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ord::class,
        ]);
    }
}

