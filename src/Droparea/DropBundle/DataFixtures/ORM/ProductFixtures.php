<?php

namespace Droparea\DropBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Droparea\DropBundle\Entity\Product;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setName('product '.$i);
            $product->setCost(mt_rand(10, 100));
            $product->setImage('fixture.jpg');
            $category = $this->getReference('category'.mt_rand(0, 3));
            $product->setCategory($category);
            $product->setCountry('Ukraine');
            $product->setProductCode(99 + $i);
            $product->setRecomendedCost(mt_rand(100, 1000));
            $product->setReturnCost(50);
            $product->setValuta('UAH');
            $product->setWeight('1 kg');

            $manager->persist($product);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
        );
    }
}

