<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\Entity\Category;

/**
 * Class StockItem
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/stock_items
 */
class StockItem extends AbstractEntity
{
    const API_ENTITY_NAME = 'stock_item';
    const API_RESOURCE_NAME = 'stock_items';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var float
     * @Groups({"get"})
     * @Type("double")
     */
    protected $openingQuantity;

    /**
     * @var float
     * @Groups({"get"})
     * @Type("double")
     */
    protected $openingBalance;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $costOfSaleCategory;

    /**
     * @var Category
     */
    protected $costOfSaleCategoryEntity;

    /**
     * @var float
     * @Groups({"get"})
     * @Type("double")
     */
    protected $stockOnHand;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getOpeningQuantity()
    {
        return $this->openingQuantity;
    }

    /**
     * @return float
     */
    public function getOpeningBalance()
    {
        return $this->openingBalance;
    }

    /**
     * @return float
     */
    public function getStockOnHand()
    {
        return $this->stockOnHand;
    }

    /**
     * @return string
     */
    public function getCostOfSaleCategoryUrl()
    {
        return $this->costOfSaleCategory;
    }


    public function setCostOfSaleCategoryUrl($costOfSaleCategory)
    {
        $this->costOfSaleCategory = $costOfSaleCategory;
        return $this;
    }

    /**
     * @return costOfSaleCategory
     */
    public function getCostOfSaleCategory()
    {
        if (!$this->costOfSaleCategoryEntity) {
            $this->costOfSaleCategoryEntity = $this->getApi()->getOneResourceByUrl($this->getCostOfSaleCategoryUrl());
        }

        return $this->costOfSaleCategoryEntity;
    }

    /**
     * @param costOfSaleCategory $costOfSaleCategory
     * @return $this
     */
    public function setCostOfSaleCategory(costOfSaleCategory $costOfSaleCategory)
    {
        $this->costOfSaleCategoryEntity = $costOfSaleCategory;
        $this->costOfSaleCategory = $costOfSaleCategory->getUrl();
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