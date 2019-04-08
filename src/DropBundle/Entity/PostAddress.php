<?php

namespace DropBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * PostAddress
 *
 * @ORM\Table(name="post_address")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\PostAddressRepository")
 */
class PostAddress
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="cities", type="array")
     */
    private $cities;

    /**
     * @ORM\Column(name="areas", type="array")
     */
    private $areas;

    /**
     * @ORM\Column(name="warehouses", type="array")
     */
    private $warehouses;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $cities
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * @param array $areas
     */
    public function setAreas($areas)
    {
        $this->areas = $areas;
    }

    /**
     * @return array
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * @param array $warehouses
     */
    public function setWarehouses($warehouses)
    {
        $this->warehouses = $warehouses;
    }

    /**
     * @return array
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}

