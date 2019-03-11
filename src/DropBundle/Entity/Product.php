<?php

namespace DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\ProductRepository")
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
     * @ORM\Column(name="cost", type="string", length=255)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendedCost", type="string", length=255)
     */
    private $recommendedCost;

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
     * @ORM\Column(type="string", nullable=true)
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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

    public function getMainImage()
    {
        $img = '';
        if (is_array($this->images)) {
            foreach ($this->images as $image) {
                return $img = $image;
            }
        }
        return $img;
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
     * @return string
     */
    public function getRecommendedCost()
    {
        return $this->recommendedCost;
    }

    /**
     * @param string $recommendedCost
     */
    public function setRecommendedCost($recommendedCost)
    {
        $this->recommendedCost = $recommendedCost;
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
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

}

