<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Estimate
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/estimates
 */
class Estimate extends AbstractEntity
{
    const API_RESOURCE_NAME = 'estimates';
    const API_ENTITY_NAME = 'estimate';

    /**
     * @var string
     * @Type("string")
     * @Groups({"get"})
     */
    protected $url;

    /**
     * @Accessor(getter="getContactUrl", setter="setContactUrl")
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $contact;

    /**
     * @var Contact
     */
    protected $contactEntity;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $reference;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $estimateType;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $status;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $notes;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $currency;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $netValue;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $salesTaxValue;

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
     * @Groups({"get", "post", "update"})
     * @Type("array<SixBySix\Freeagent\Entity\EstimateItem>")
     */
    protected $estimateItems;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getContactUrl()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     * @return $this
     */
    public function setContactUrl($contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        if (!$this->contactEntity) {
            $this->contactEntity = $this->getApi()->getOneResourceByUrl($this->getContact());
        }

        return $this->contactEntity;
    }

    /**
     * @param Contact $contact
     * @return $this
     */
    public function setContact(Contact $contact)
    {
        $this->contactEntity = $contact;
        $this->contact = $contact->getUrl();
        return $this;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    // @todo pdf download and transition methods
}
