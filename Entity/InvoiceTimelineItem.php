<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;

/**
 * Class InvoiceItem
 * @package SixBySix\Freeagent\Entity
 * @todo this entity is "dumb" for now, will add getInvoice getProject getClient methods
 */
class InvoiceTimelineItem extends AbstractEntity
{
    const API_RESOURCE_NAME = 'invoices/timeline';
    const API_ENTITY_NAME = 'invoice_timeline_item';

    /**
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @Groups({"get"})
     * @Type("double")
     */
    protected $amount;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $summary;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $reference;

    /**
     * @return mixed
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    public function getUrl()
    {
        // do nothing
    }
}