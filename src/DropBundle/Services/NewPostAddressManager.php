<?php

namespace DropBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use DropBundle\Entity\PostAddress;

/**
 * Class GetNewPostAddressFromDB
 * Return New Post address from DB
 */
class NewPostAddressManager
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return array|null
     */
    public function getCities()
    {
        if ($cityObjects = $this->em->getRepository(PostAddress::class)->findAll()) {
            foreach ($cityObjects as $cityObject) {
                $citiesArray = $cityObject->getCities();
            }
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
        if ($warehouseObject = $this->em->getRepository(PostAddress::class)->findLastUpdatedPostAddress()) {
            $listWarehouses = [];
            $warehousesArray = $warehouseObject[0]->getWarehouses();
            foreach ($warehousesArray as $warehouse) {
                if ($warehouse['CityDescriptionRu'] == $cityDescriptionRu) {
                    $listWarehouses[] = $warehouse['DescriptionRu'];
                }
            }
            return $listWarehouses;
        }
    }
}

