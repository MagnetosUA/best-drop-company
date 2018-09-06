<?php

namespace Droparea\DropBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Droparea\DropBundle\Entity\Product;

class ProductFixtures extends Fixture
{
    public $images = ['ola.jpeg', 'gps.jpeg', 'husq.jpeg'];//, 'tv.jpeg', 'iphone.jpeg'];

    public $description = 'Особенности Соединение с телефоном по Bluetooth Встроенная память 8 ГБ в комплекте Детектирование камер и радаров полиции по GPS-базе с регулярным автоматическим обновлением Голосовое сопровождение На русском языке Поворотный кронштейн Батарея регистратора 30 минут Bluetooth Bluetooth Smart';

    public function load(ObjectManager $manager)
    {

        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName('Товар '.$i);
            $product->setCost(mt_rand(10, 100));
            $product->setImages($this->images);
            $product->setDescription($this->description);
            $category = $this->getReference('category'.mt_rand(0, 3));
            $product->setCategory($category);
            $product->setCountry('Ukraine');
            $product->setProductCode(99 + $i);
            $product->setRecomendedCost(mt_rand(100, 1000));
            $product->setReturnCost(50);
            $product->setValuta('UAH');
            $product->setWeight('1 kg');
            $product->setPurveyor('Юлька');

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

