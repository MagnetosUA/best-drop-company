<?php

namespace DropBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DropBundle\Entity\Category;
use DropBundle\Entity\Product;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $arrProducts = ['Автотовары', 'Електроника', 'Мода', 'Красота и здоровье', 'Товары для дома', 'Разное'];
        // create 4 categories! Bam!
        for ($i = 0; $i < 6; $i++) {
            $category = new Category();
            $category->setName($arrProducts[$i]);
            $this->addReference('category'.$i, $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
