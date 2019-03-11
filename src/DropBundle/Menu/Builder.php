<?php

namespace DropBundle\Menu;

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
                'route' => 'user_view.products'
            ]);
        $menu->addChild('Заказы', [
                'route' => 'user_view.orders'
            ]);
        $menu->addChild('Выплаты' ,[
                'route' => 'user_view.payments'
            ]);
        $menu->addChild('Статистика', [
                'route' => 'user_view.statistic'
            ]);
        $menu->addChild('Рефералы', [
                'route' => 'user_view.referrals'
            ]);
        $menu->addChild('Новости', [
                'route' => 'user_view.news'
            ]);
//        $menu->addChild(" ", [
//            'uri' => '#',
////            'route' => 'news',
//        ]);
//        $menu[' ']->setLinkAttribute('class', 'icon');

        return $menu;
    }

}

