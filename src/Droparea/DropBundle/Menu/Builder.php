<?php

namespace Droparea\DropBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'nav main-nav navbar-nav',
            ]
        ]);
        $menu->addChild('Товары', [
                'route' => 'products'
            ]);
        $menu->addChild('Заказы', [
                'route' => 'orders'
            ]);
        $menu->addChild('Выплаты' ,[
                'route' => 'payments'
            ]);
        $menu->addChild('Статистика', [
                'route' => 'statistic'
            ]);
        $menu->addChild('Рефералы', [
                'route' => 'referals'
            ]);
        $menu->addChild('Новости', [
                'route' => 'news'
            ]);

        return $menu;
    }

}

