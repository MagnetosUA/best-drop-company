<?php

namespace DropBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostAddress
 *
 * @ORM\Table(name="post_address")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\PostAddressRepository")
 */
class PostAddress
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="cities", type="array")
     */
    private $cities;

    /**
     * @var array
     *
     * @ORM\Column(name="areas", type="array")
     */
    private $areas;

    /**
     * @var array
     *
     * @ORM\Column(name="warehouses", type="array")
     */
    private $warehouses;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cities
     *
     * @param array $cities
     *
     * @return PostAddress
     */
    public function setCities($cities)
    {
        $this->cities = $cities;

        return $this;
    }

    /**
     * Get cities
     *
     * @return array
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Set areas
     *
     * @param array $areas
     *
     * @return PostAddress
     */
    public function setAreas($areas)
    {
        $this->areas = $areas;

        return $this;
    }

    /**
     * Get areas
     *
     * @return array
     */
    public function getAreas()
    {
        return $this->areas;
    }

    /**
     * Set warehouses
     *
     * @param array $warehouses
     *
     * @return PostAddress
     */
    public function setWarehouses($warehouses)
    {
        $this->warehouses = $warehouses;

        return $this;
    }

    /**
     * Get warehouses
     *
     * @return array
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }
}

