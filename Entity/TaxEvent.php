<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class TaxEvent
 * @package SixBySix\Freeagent\Entity\Company
 * @see https://dev.freeagent.com/docs/company#information-about-upcoming-tax-events
 */
class TaxEvent extends AbstractEntity
{
    const API_ENTITY_NAME = '';
    const API_RESOURCE_NAME = 'company/tax_timeline';


    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $nature;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var float
     * @Groups({"get"})
     * @Type("double")
     */
    protected $amountDue;

    /**
     * @var bool
     * @Groups({"get"})
     * @Type("boolean")
     */
    protected $isPersonal;

    public function getUrl()
    {
        return '';
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
    public function getNature()
    {
        return $this->nature;
    }

    /**
     * @return \DateTime
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @return double
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

    /**
     * @return boolean
     */
    public function getIsPersonal()
    {
        return $this->isPersonal;
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