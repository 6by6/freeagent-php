<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class InvoiceItem
 * @package SixBySix\Freeagent\Entity
 */
class InvoiceItem extends AbstractEntity
{
    const API_RESOURCE_NAME = 'invoice_items';
    const API_ENTITY_NAME = 'invoice_item';

    const ITEM_TYPE_HOURS = "Hours";
    const ITEM_TYPE_DAYS = "Days";
    const ITEM_TYPE_WEEKS = "Weeks";
    const ITEM_TYPE_MONTHS = "Months";
    const ITEM_TYPE_YEARS = "Years";
    const ITEM_TYPE_NOUNIT = "-no unit-";
    const ITEM_TYPE_PRODUCTS = "Products";
    const ITEM_TYPE_SERVICES = "Services";
    const ITEM_TYPE_TRAINING = "Training";
    const ITEM_TYPE_EXPENSES = "Expenses";
    const ITEM_TYPE_COMMENT = "Comment";
    const ITEM_TYPE_BILLS = "Bills";
    const ITEM_TYPE_DISCOUNT = "Discount";
    const ITEM_TYPE_CREDIT = "Credit";
    const ITEM_TYPE_VAT = "VAT";

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

    /**
     * @var integer
     * @Groups({"post", "update", "get"})
     * @Type("integer");
     */
    protected $position;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $itemType;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $price;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $quantity;

    /**
     * @var bool
     * @SerializedName("_destroy")
     * @Groups({"update"})
     * @Type("boolean")
     */
    protected $destroy;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param mixed $itemType
     * @return $this
     */
    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getDestroy()
    {
        return $this->destroy;
    }

    /**
     * @param boolean $destroy
     * @return $this
     */
    public function setDestroy($destroy)
    {
        $this->destroy = $destroy;
        return $this;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }
}