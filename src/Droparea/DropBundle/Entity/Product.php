<?php

namespace Droparea\DropBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @var string
     *
     * @ORM\Column(name="productCode", type="string", length=255, unique=true)
     */
    private $productCode;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="image", type="string", length=255)
     * @Assert\NotBlank(message="Пожалуйста, загрузите фотографию !")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $image;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set productCode
     *
     * @param string $productCode
     *
     * @return Product
     */
    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;

        return $this;
    }

    /**
     * Get productCode
     *
     * @return string
     */
    public function getProductCode()
    {
        return $this->productCode;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
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
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
}

