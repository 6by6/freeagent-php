<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\Category;

/**
 * Class EstimateItem
 * @package SixBySix\Freeagent\Entity\Estimate
 * @see https://dev.freeagent.com/docs/estimates#create-an-estimate-item
 */
class EstimateItem extends AbstractEntity
{
    const API_ENTITY_NAME = 'estimate_item';
    const API_RESOURCE_NAME = 'estimate_items';

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
     * @var integer
     * @Groups({"post", "update", "get"})
     * @Type("integer");
     */
    protected $quantity;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $price;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $description;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $salesTaxValue;

    /**
     * @Accessor(getter="getCategoryUrl", setter="setCategoryUrl")
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $category;

    /**
     * @var Category
     */
    protected $categoryEntity;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $createdAt;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return float
     */
    public function getSalesTaxValue()
    {
        return $this->salesTaxValue;
    }

    /**
     * @param float $salesTaxValue
     */
    public function setSalesTaxValue($salesTaxValue)
    {
        $this->salesTaxValue = $salesTaxValue;
    }

    /**
     * @return mixed
     */
    public function getCategoryUrl()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return $this
     */
    public function setCategoryUrl($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        if (!$this->categoryEntity) {
            $this->categoryEntity = $this->getApi()->getOneResourceByUrl($this->getCategoryUrl());
        }

        return $this->categoryEntity;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category)
    {
        $this->categoryEntity = $category;
        $this->category = $category->getUrl();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }
}