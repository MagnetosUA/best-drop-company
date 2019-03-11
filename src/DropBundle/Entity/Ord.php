<?php

namespace DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ord
 *
 * @ORM\Table(name="ord")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\OrdRepository")
 */
class Ord
{
    /* Order Statuses */

    const NEW_ORDER = 'Новый';
    const IN_PROCESSING = 'В обработке';
    const CONFIRMED = 'Подтвержденный';
    const REJECTED = 'Отклоненный';
    const SHIPPED = 'Отправленный';
    const NON_PURCHASE = 'Невыкуп';

    /* Settlement types */

    const COD = 'Наложенный платеж';
    const TO_CARD = 'Перевод на банковскую карту';

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
    private $settlementType = self::COD;

    /**
     * @ORM\Column(name="clientPhone", type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(max="20")
     */
    private $clientPhone;

    /**
     * @ORM\Column(name="clientName", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(max="255")
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
     * @Assert\Type("string")
     * @Assert\Length(max="1500")
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
       return (string) $this->getId();
    }

    /**
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
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $saleAmount
     */
    public function setSaleAmount($saleAmount)
    {
        $this->saleAmount = $saleAmount;
    }

    /**
     * @return string
     */
    public function getSaleAmount()
    {
        return $this->saleAmount;
    }

    /**
     * @param string $purchaseAmount
     */
    public function setPurchaseAmount($purchaseAmount)
    {
        $this->purchaseAmount = $purchaseAmount;
    }

    /**
     * @return string
     */
    public function getPurchaseAmount()
    {
        return $this->purchaseAmount;
    }

    /**
     * @param string $income
     */
    public function setIncome($income)
    {
        $this->income = $income;
    }

    /**
     * @return string
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * @param string $settlementType
     */
    public function setSettlementType($settlementType)
    {
        $this->settlementType = $settlementType;
    }

    /**
     * @return string
     */
    public function getSettlementType()
    {
        return $this->settlementType;
    }

    /**
     * @param string $clientPhone
     */
    public function setClientPhone($clientPhone)
    {
        $this->clientPhone = $clientPhone;
    }

    /**
     * @return string
     */
    public function getClientPhone()
    {
        return $this->clientPhone;
    }

    /**
     * @param string $clientName
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;
    }

    /**
     * @return string
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * @param string $waybill
     */
    public function setWaybill($waybill)
    {
        $this->waybill = $waybill;
    }

    /**
     * @return string
     */
    public function getWaybill()
    {
        return $this->waybill;
    }

    /**
     * @param string $deliveryAddress
     */
    public function setDeliveryAddress($deliveryAddress)
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    /**
     * @return string
     */
    public function getDeliveryAddress()
    {
        return $this->deliveryAddress;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;
    }

    /**
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
        $user->addOrders($this);
    }
}

