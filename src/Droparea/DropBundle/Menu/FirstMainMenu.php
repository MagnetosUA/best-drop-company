<?php

namespace Droparea\DropBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class FirstMainMenu implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainGuestMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'nav main-nav navbar-nav',
            ]
        ]);
        $menu->addChild('Главная', [
            'route' => 'drop_homepage'
        ]);
        $menu->addChild('Каталог', [
            'route' => 'catalogue'
        ]);
        $menu->addChild('Описание', [
            'uri' => '#',
        ]);
        $menu->addChild('Преимущества', [
            'uri' => '#',
        ]);
        $menu->addChild('Вход', [
            'route' => 'security_login'
        ]);

        return $menu;
    }

}

