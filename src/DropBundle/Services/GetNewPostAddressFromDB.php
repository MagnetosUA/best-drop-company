<?php

namespace DropBundle\Services;

use Doctrine\Common\Persistence\ObjectManager;
use Droparea\DropBundle\Entity\PostAddress;

/**
 * Class GetNewPostAddressFromDB
 * Return New Post address from DB
 */
class GetNewPostAddressFromDB
{
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array|null
     */
    public function getCities()
    {
        if ($cityObject = $this->em->getRepository(PostAddress::class)->find(1)) {
            $citiesArray = $cityObject->getCities();
//        echo "<pre>";
//        print_r($citiesArray);
//        echo "</pre>";die;
            $staticSitiesFull = [];
            $areas = [];
            foreach ($citiesArray['data'] as $city) {
                $staticSitiesFull[] = $city['DescriptionRu'];
                $areas[] = $city['Area'];
            }
            $staticSitiesFull = array_flip($staticSitiesFull);
            foreach ($staticSitiesFull as $key => $item) {
                $staticSitiesFull[$key] = $key;
            }
            return $staticSitiesFull;
        }
        return null;
    }

    /**
     * @param $descriptionCityRu
     * @return null
     */
    public function getArea($descriptionCityRu)
    {
        if ($cityObject = $this->em->getRepository(PostAddress::class)->find(1)) {
            $citiesArray = $cityObject->getCities();
            $areaArray = $cityObject->getAreas();
//            echo "<pre>";
//            print_r($areaArray);
//            echo "</pre>";die;
            foreach ($citiesArray['data'] as $city) {
                if ($city['DescriptionRu'] == $descriptionCityRu) {
                    foreach ($areaArray as $key => $value) {
                        if ($key == $city['Area']) {
                            return $areaArray[$key]['AreaRu'];
                        }
                    }
                }
            }
        }
        return null;
    }

    /**
     * @param $cityDescriptionRu
     * @return array
     */
    public function getWarehouses($cityDescriptionRu)
    {
        if ($cityDescriptionRu == null) {
            return [' ' => ' '];
        }
        if ($warehouseObject = $this->em->getRepository(PostAddress::class)->find(1)) {
            $warehousesArray = $warehouseObject->getWarehouses();
//            echo "<pre>";
//            print_r($warehousesArray);
//            echo "</pre>";
//            die;
            foreach ($warehousesArray as $warehouse) {
                if ($warehouse['CityDescriptionRu'] == $cityDescriptionRu) {
                    $listWarehouses[] = $warehouse['DescriptionRu'];
                }
            }
            return $listWarehouses;
        }
    }

}

