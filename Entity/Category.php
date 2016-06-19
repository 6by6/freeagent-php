<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Category
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/categories
 */
class Category extends AbstractEntity
{
    const API_RESOURCE_NAME = 'categories';
    const API_ENTITY_NAME = 'category';

    /**
     * @var string
     * @Type("string")
     * @Group({"get"})
     */
    protected $url;

    /**
     * @var string
     * @Type("string")
     * @Group({"get"})
     */
    protected $description;

    /**
     * @var string
     * @Type("string")
     * @Group({"get"})
     */
    protected $nominalCode;

    /**
     * @var bool
     * @Type("boolean")
     * @Group({"get"})
     */
    protected $allowableForTax;

    /**
     * @var string
     * @Type("string")
     * @Group({"get"})
     */
    protected $taxReportingName;

    /**
     * @var float
     * @Type("double")
     * @Group({"get"})
     */
    protected $autoSalesTaxRate;

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
     * @return string
     */
    public function getNominalCode()
    {
        return $this->nominalCode;
    }

    /**
     * @return boolean
     */
    public function isAllowableForTax()
    {
        return $this->allowableForTax;
    }

    /**
     * @return string
     */
    public function getTaxReportingName()
    {
        return $this->taxReportingName;
    }

    /**
     * @return float
     */
    public function getAutoSalesTaxRate()
    {
        return $this->autoSalesTaxRate;
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