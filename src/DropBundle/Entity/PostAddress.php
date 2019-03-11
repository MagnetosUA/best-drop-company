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
     */
    public function setCities($cities)
    {
        $this->cities = $cities;
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
     */
    public function setAreas($areas)
    {
        $this->areas = $areas;
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
     */
    public function setWarehouses($warehouses)
    {
        $this->warehouses = $warehouses;
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

