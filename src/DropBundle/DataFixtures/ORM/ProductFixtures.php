<?php

namespace DropBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use DropBundle\Entity\Product;

class ProductFixtures extends Fixture
{
    public $images = ['iphone.jpeg', 'gps.jpeg', 'tv.jpeg', 'a8e9f822bc3fbcf45f0956e67f69c742.jpeg'];//, 'tv.jpeg', 'iphone.jpeg'];

    public $description = 'Особенности Соединение с телефоном по Bluetooth Встроенная память 8 ГБ в комплекте Детектирование камер и радаров полиции по GPS-базе с регулярным автоматическим обновлением Голосовое сопровождение На русском языке Поворотный кронштейн Батарея регистратора 30 минут Bluetooth Bluetooth Smart';

    public function load(ObjectManager $manager)
    {
        // create 10 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('Товар '.$i);
            $product->setCost(mt_rand(300, 1500));
            $product->setImages($this->images);
            $product->setDescription($this->description);
            $category = $this->getReference('category'.mt_rand(0, 3));
            $product->setCategory($category);
            $product->setRecomendedCost(mt_rand(100, 1000));
            $product->setReturnCost(50);
            $product->setWeight('1 kg');
            $product->setPurveyor('Julia');
            $product->setTop(true);

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

