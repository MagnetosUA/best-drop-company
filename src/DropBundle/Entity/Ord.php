<?php

namespace DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Ord
 *
 * @ORM\Table(name="ord")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\OrdRepository")
 */
class Ord
{
    const NEW_ORDER = 'Новый';
    const IN_PROCESSING = 'В обработке';
    const CONFIRMED = 'Подтвержденный';
    const REJECTED = 'Отклоненный';
    const SHIPPED = 'Отправленный';
    const NON_PURCHASE = 'Невыкуп';

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * Many Orders have many Products
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="orders")
     */
    private $products;

    /**
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status = self::NEW_ORDER;

    /**
     * @ORM\Column(name="saleAmount", type="integer")
     */
    private $saleAmount = 0;

    /**
     * @ORM\Column(name="purchaseAmount", type="integer")
     */
    private $purchaseAmount = 0;

    /**
     * @ORM\Column(name="income", type="integer")
     */
    private $income = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="settlementType", type="string", length=255)
     */
    private $settlementType = "C.O.D.";

    /**
     * @ORM\Column(name="clientPhone", type="string", length=255)
     */
    private $clientPhone;

    /**
     * @ORM\Column(name="clientName", type="string", length=255)
     */
    private $clientName;

    /**
     * @ORM\Column(name="waybill", type="string", length=255)
     */
    private $waybill = 'Будет доступен после отправки';

    /**
     * @ORM\Column(name="deliveryAddress", type="string", length=1000)
     */
    private $deliveryAddress;

    /**
     * @ORM\Column(name="comment", type="string", length=1500, nullable=true)
     */
    private $comment;

    /**
     * Many Orders have One User.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     */
    private $user;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        $id = $this->getId();
        return "$id";
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
     * @param Product $product
     * @return $this
     */
    public function addProducts(Product $product)
    {
        $this->products[] = $product;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * Set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set saleAmount
     *
     * @param string $saleAmount
     */
    public function setSaleAmount($saleAmount)
    {
        $this->saleAmount = $saleAmount;
    }

    /**
     * Get saleAmount
     *
     * @return string
     */
    public function getSaleAmount()
    {
        return $this->saleAmount;
    }

    /**
     * Set purchaseAmount
     *
     * @param string $purchaseAmount
     */
    public function setPurchaseAmount($purchaseAmount)
    {
        $this->purchaseAmount = $purchaseAmount;
    }

    /**
     * Get purchaseAmount
     *
     * @return string
     */
    public function getPurchaseAmount()
    {
        return $this->purchaseAmount;
    }

    /**
     * Set income
     *
     * @param string $income
     */
    public function setIncome($income)
    {
        $this->income = $income;
    }

    /**
     * Get income
     *
     * @return string
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * Set settlementType
     *
     * @param string $settlementType
     *
     * @return Ord
     */
    public function setSettlementType($settlementType)
    {
        $this->settlementType = $settlementType;

        return $this;
    }

    /**
     * Get settlementType
     *
     * @return string
     */
    public function getSettlementType()
    {
        return $this->settlementType;
    }

    /**
     * Set clientPhone
     *
     * @param string $clientPhone
     */
    public function setClientPhone($clientPhone)
    {
        $this->clientPhone = $clientPhone;
    }

    /**
     * Get clientPhone
     *
     * @return string
     */
    public function getClientPhone()
    {
        return $this->clientPhone;
    }

    /**
     * Set clientName
     *
     * @param string $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * Get clientName
     *
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set waybill
     *
     * @param string $waybill
     */
    public function setWaybill($waybill)
    {
        $this->waybill = $waybill;
    }

    /**
     * Get waybill
     *
     * @return string
     */
    public function getWaybill()
    {
        return $this->waybill;
    }

    /**
     * Set deliveryAddress
     *
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * Get deliveryAddress
     *
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * Set comment
     *
     * @param string $comment
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
        $user->addOrder($this);
    }
}

