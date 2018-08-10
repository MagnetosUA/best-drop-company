<?php

namespace Droparea\DropBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $arrProducts = ['Спорт товары', 'Електроника', 'Бытовые товары', 'Одежда'];
        // create 4 categories! Bam!
        for ($i = 0; $i < 4; $i++) {
            $category = new Category();
            $category->setName($arrProducts[$i]);
            $this->addReference('category'.$i, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}

