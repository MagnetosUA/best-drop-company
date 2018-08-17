<?php

namespace Droparea\DropBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Droparea\DropBundle\Entity\PostAddress;
use LisDev\Delivery\NovaPoshtaApi2;

class FetchNewPostAddress
{
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var array of Areas (static)
     */
    public $lisOfAreas = array(
        '71508129-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Вінниця',
            'DescriptionRu' => 'Винница',
            'Area' => 'Вінницька',
            'AreaRu' => 'Винницкая',
        ),
        '7150812b-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Дніпропетровськ',
            'DescriptionRu' => 'Днепропетровск',
            'Area' => 'Дніпропетровська',
            'AreaRu' => 'Днепропетровская',
        ),
        '7150812c-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Донецьк',
            'DescriptionRu' => 'Донецк',
            'Area' => 'Донецька',
            'AreaRu' => 'Донецкая',
        ),
        '7150812d-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Житомир',
            'DescriptionRu' => 'Житомир',
            'Area' => 'Житомирська',
            'AreaRu' => 'Житомирская',
        ),
        '7150812f-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Запоріжжя',
            'DescriptionRu' => 'Запорожье',
            'Area' => 'Запорізька',
            'AreaRu' => 'Запорожская',
        ),
        '71508130-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Івано-Франківськ',
            'DescriptionRu' => 'Ивано-Франковск',
            'Area' => 'Івано-Франківська',
            'AreaRu' => 'Ивано-Франковская',
        ),
        '71508131-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Київ',
            'DescriptionRu' => 'Киев',
            'Area' => 'Київська',
            'AreaRu' => 'Киевская',
        ),
        '71508132-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Кіровоград',
            'DescriptionRu' => 'Кировоград',
            'Area' => 'Кіровоградська',
            'AreaRu' => 'Кировоградская',
        ),
        '71508133-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Луганськ',
            'DescriptionRu' => 'Луганск',
            'Area' => 'Луганська',
            'AreaRu' => 'Луганская',
        ),
        '7150812a-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Луцьк',
            'DescriptionRu' => 'Луцк',
            'Area' => 'Волинська',
            'AreaRu' => 'Волынская',
        ),
        '71508134-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Львів',
            'DescriptionRu' => 'Львов',
            'Area' => 'Львівська',
            'AreaRu' => 'Львовская',
        ),
        '71508135-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Миколаїв',
            'DescriptionRu' => 'Николаев',
            'Area' => 'Миколаївська',
            'AreaRu' => 'Николаевская',
        ),
        '71508136-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Одеса',
            'DescriptionRu' => 'Одесса',
            'Area' => 'Одеська',
            'AreaRu' => 'Одесская',
        ),
        '71508137-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Полтава',
            'DescriptionRu' => 'Полтава',
            'Area' => 'Полтавська',
            'AreaRu' => 'Полтавская',
        ),
        '71508138-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Рівне',
            'DescriptionRu' => 'Ровно',
            'Area' => 'Рівненська',
            'AreaRu' => 'Ровненская',
        ),
        '71508139-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Суми',
            'DescriptionRu' => 'Сумы',
            'Area' => 'Сумська',
            'AreaRu' => 'Сумская',
        ),
        '7150813a-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Тернопіль',
            'DescriptionRu' => 'Тернополь',
            'Area' => 'Тернопільська',
            'AreaRu' => 'Тернопольская',
        ),
        '7150812e-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Ужгород',
            'DescriptionRu' => 'Ужгород',
            'Area' => 'Закарпатська',
            'AreaRu' => 'Закарпатская',
        ),
        '7150813b-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Харків',
            'DescriptionRu' => 'Харьков',
            'Area' => 'Харківська',
            'AreaRu' => 'Харьковская',
        ),
        '7150813c-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Херсон',
            'DescriptionRu' => 'Херсон',
            'Area' => 'Херсонська',
            'AreaRu' => 'Херсонская',
        ),
        '7150813d-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Хмельницький',
            'DescriptionRu' => 'Хмельницкий',
            'Area' => 'Хмельницька',
            'AreaRu' => 'Хмельницкая',
        ),
        '7150813e-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Черкаси',
            'DescriptionRu' => 'Черкассы',
            'Area' => 'Черкаська',
            'AreaRu' => 'Черкасская',
        ),
        '71508140-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Чернігів',
            'DescriptionRu' => 'Чернигов',
            'Area' => 'Чернігівська',
            'AreaRu' => 'Черниговская',
        ),
        '7150813f-9b87-11de-822f-000c2965ae0e' => array(
            'Description' => 'Чернівці',
            'DescriptionRu' => 'Черновцы',
            'Area' => 'Чернівецька',
            'AreaRu' => 'Черновицкая',
        ),
    );

    /**
     * @var string
     * my API key of NEW POST
     */
    private $myApiKey = 'bbd31a0c4e0801075b2253a36e0403ad';

    /**
     * @var NovaPoshtaApi2
     */
    private $np;

    //public $cities = ['city' => [], 'region' => []];

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
        $this->np = new NovaPoshtaApi2($this->myApiKey);
    }

    /**
     * @return string
     * Getting array of Cities from NEW POST
     */
    public function getCities()
    {
        $postAddress = new PostAddress();
        if ($cities = $this->np->getCities()) {
            $postAddress->setCities($cities);
            $this->em->persist($postAddress);
            $this->em->flush();
            return "Cities are updated successfully !";
        } else {
            return "Something wrong! The data was not fetched !";
        }
    }

    /**
     * @return mixed
     * Getting array of Areas from NEW POST
     */
    public function getArea()
    {
//        foreach ($this->lisOfAreas as $key => $area) {
//            if ($key == $ref) {
//                return $area['AreaRu'];
//            }
//        }
        $ar = $this->np->getAreas('Черкаcc');
        var_dump($ar);die;
    }

    /**
     * @param $city
     * @return mixed
     * Getting array of Warehouses from NEW POST
     */
    public function getWarehouses($city)
    {
        $c = $this->np->getCities('', $city);
        $result = $this->np->getWarehouses($c['data'][1]['Ref']);
        return $result;
    }

}

