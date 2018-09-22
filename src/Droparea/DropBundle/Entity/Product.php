<?php

namespace Droparea\DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Droparea\DropBundle\Repository\ProductRepository")
 */
class Product
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
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var array
     * @ORM\Column(name="images", type="array")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=255)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="string", length=255)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendedCost", type="string", length=255)
     */
    private $recomendedCost;

    /**
     * @var string
     *
     * @ORM\Column(name="returnCost", type="string", length=255)
     */
    private $returnCost;

    /**
     * @var string
     *
     * @ORM\Column(name="valuta", type="string", length=255)
     */
    private $valuta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="new", type="boolean")
     */
    private $new = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="top", type="boolean")
     */
    private $top = false;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=3000)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(name="purveyor", type="string", length=700)
     */
    private $purveyor;

    /**
     * @ORM\ManyToMany(targetEntity="Ord", mappedBy="products")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

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
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param array $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }


    /**
     * Set country
     *
     * @param string $country
     *
     * @return Product
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set cost
     *
     * @param string $cost
     *
     * @return Product
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set recomendedCost
     *
     * @param string $recomendedCost
     *
     * @return Product
     */
    public function setRecomendedCost($recomendedCost)
    {
        $this->recomendedCost = $recomendedCost;

        return $this;
    }

    /**
     * Get recomendedCost
     *
     * @return string
     */
    public function getRecomendedCost()
    {
        return $this->recomendedCost;
    }

    /**
     * Set returnCost
     *
     * @param string $returnCost
     *
     * @return Product
     */
    public function setReturnCost($returnCost)
    {
        $this->returnCost = $returnCost;

        return $this;
    }

    /**
     * Get returnCost
     *
     * @return string
     */
    public function getReturnCost()
    {
        return $this->returnCost;
    }

    /**
     * Set valuta
     *
     * @param string $valuta
     *
     * @return Product
     */
    public function setValuta($valuta)
    {
        $this->valuta = $valuta;

        return $this;
    }

    /**
     * Get valuta
     *
     * @return string
     */
    public function getValuta()
    {
        return $this->valuta;
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * @param bool $new
     */
    public function setNew($new)
    {
        $this->new = $new;
    }

    /**
     * @return bool
     */
    public function isTop()
    {
        return $this->top;
    }

    /**
     * @param bool $top
     */
    public function setTop($top)
    {
        $this->top = $top;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPurveyor()
    {
        return $this->purveyor;
    }

    /**
     * @param string $purveyor
     */
    public function setPurveyor($purveyor)
    {
        $this->purveyor = $purveyor;
    }

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param mixed $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
    }


}

