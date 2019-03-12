<?php

namespace DropBundle\Menu;

use DropBundle\Entity\Category;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
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
            'route' => 'guest.home'
        ]);
        $menu->addChild('Описание', [
            'uri' => '#description',
        ]);
        $menu->addChild('Преимущества', [
            'uri' => '#advantages',
        ]);
        $menu->addChild('Список товаров', [
            'route' => 'guest.product_list'
        ]);
        $menu->addChild('Вход', [
            'route' => 'security_login'
        ]);

        return $menu;
    }

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

        return $menu;
    }

    public function categoryMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('category', [
            'childrenAttributes' => [
                'class' => 'nav main-nav navbar-nav category-menu',
            ]
        ]);

        $categories = $this->container->get('doctrine')->getRepository(Category::class)->findAll();

        foreach ($categories as $category) {
            $name = $category->getName();
            $slug = $category->getSlug();
            $menu->addChild($name, [
                'route' => 'user_view.product_list_by_category',
                'routeParameters' => ['slug' => $slug]
            ]);
        }

        return $menu;
    }
}

