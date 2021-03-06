<?php

namespace DropBundle\DataFixtures\Provider;


class CategoryProvider
{
    /**
     * Names of categories
     */
    const NAMES = [
        'Товары для дома',
        'Электроника',
        'Одежда',
        'Дом и Сад',
        'Бытовая техника',
    ];
//    const NAMES = [
//        'Household products',
//        'Electronics',
//        'Clothing',
//        'A house and a garden',
//        'Appliances'
//        ];


    /**
     * Count of function calls
     */
    private static $count = 0;

    /**
     * Main function that colling in fixtyres.yml
     */
    public static function category()
    {
        $val = self::NAMES[self::$count];
        self::$count++;
        return $val;
    }
}

