<?php

namespace Droparea\DropBundle\Services;

use LisDev\Delivery\NovaPoshtaApi2;

class NewPostAddress
{
    private $myApiKey = 'bbd31a0c4e0801075b2253a36e0403ad';

    private $np;

    public $cities = [];

    public function __construct()
    {
        $this->np = new NovaPoshtaApi2($this->myApiKey);
    }

    public function getCities()
    {
        $listCities = $this->np->getCities();
        foreach ($listCities['data'] as $city) {
            $this->cities[] = $city['DescriptionRu'];
        }
        return $this->cities;
    }
}

