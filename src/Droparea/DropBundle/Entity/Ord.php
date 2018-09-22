<?php

namespace Droparea\DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Ord
 *
 * @ORM\Table(name="ord")
 * @ORM\Entity(repositoryClass="Droparea\DropBundle\Repository\OrdRepository")
 */
class Ord
{
    const NEW_OREDER = 'Новый';
    const IN_PROCESSING = 'В обработке';
    const NERPOKE = 'Недозвон';
    const CONFIRMED = 'Подтвержденный';
    const REJECTED = 'Отклоненный';
    const SHIPPED = 'Отправленный';
    const NON_PURCHASE = 'Невыкуп';
    const RANSOM = 'Выкуп';
    const NOT_SENT_FOR_PROCESSING = 'Не отправлен в обработку';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="orderNumber", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $orderNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * Many Orders have many Products
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="orders")
     */
    private $products;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="saleAmount", type="string", length=255)
     */
    private $saleAmount = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="purchaseAmount", type="string", length=255)
     */
    private $purchaseAmount = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="income", type="string", length=255)
     */
    private $income = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="treatmentType", type="string", length=255)
     */
    private $treatmentType = "dropshipping";

    /**
     * @var string
     *
     * @ORM\Column(name="settlementType", type="string", length=255)
     */
    private $settlementType = "C.O.D.";

    /**
     * @var string
     *
     * @ORM\Column(name="clientPhone", type="string", length=255)
     */
    private $clientPhone;

    /**
     * @var string
     *
     * @ORM\Column(name="clientName", type="string", length=255)
     */
    private $clientName;

    /**
     * @var string
     *
     * @ORM\Column(name="waybill", type="string", length=255)
     */
    private $waybill = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="deliveryAddress", type="string", length=1000)
     */
    private $deliveryAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="string", length=1500)
     */
    private $comment;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source = 0;


    /**
     * Many Orders have One User.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
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
     * Set orderNumber
     *
     * @param integer $orderNumber
     *
     * @return Ord
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    /**
     * Get orderNumber
     *
     * @return int
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Ord
     */
    public function setCreated()
    {
        $this->created = new \DateTime();
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Ord
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
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
     *
     * @return Ord
     */
    public function setSaleAmount($saleAmount)
    {
        $this->saleAmount = $saleAmount;

        return $this;
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
     *
     * @return Ord
     */
    public function setPurchaseAmount($purchaseAmount)
    {
        $this->purchaseAmount = $purchaseAmount;

        return $this;
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
     *
     * @return Ord
     */
    public function setIncome($income)
    {
        $this->income = $income;

        return $this;
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
     * Set treatmentType
     *
     * @param string $treatmentType
     *
     * @return Ord
     */
    public function setTreatmentType($treatmentType)
    {
        $this->treatmentType = $treatmentType;

        return $this;
    }

    /**
     * Get treatmentType
     *
     * @return string
     */
    public function getTreatmentType()
    {
        return $this->treatmentType;
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
     *
     * @return Ord
     */
    public function setClientPhone($clientPhone)
    {
        $this->clientPhone = $clientPhone;

        return $this;
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
     *
     * @return Ord
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
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
     *
     * @return Ord
     */
    public function setWaybill($waybill)
    {
        $this->waybill = $waybill;

        return $this;
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
     *
     * @return Ord
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
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
     *
     * @return Ord
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
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
     * Set source
     *
     * @param string $source
     *
     * @return Ord
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}

