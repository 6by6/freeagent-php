<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Project
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/projects
 */
class Project extends AbstractEntity
{
    const API_RESOURCE_NAME = 'projects';
    const API_ENTITY_NAME = 'project';

    const STATUS_ACTIVE = 'Active';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_CANCELLED = 'Cancelled';
    const STATUS_HIDDEN = 'Hidden';

    const UNITS_HOURS = 'Hours';
    const UNITS_DAYS = 'Days';
    const UNITS_MONETARY = 'Monetary';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $name;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     * @Accessor(getter="getContactUrl", setter="setContactUrl")
     */
    protected $contact;

    /**
     * @var Contact
     */
    protected $contactEntity;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $budget;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean")
     */
    protected $isIr35;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $status;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $budgetUnits;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $normalBillingRate;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $hoursPerDay;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean")
     */
    protected $usesProjectInvoiceSequence;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $billingPeriod;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $updatedAt;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactUrl()
    {
        return $this->contact;
    }

    /**
     * @param string $contactUrl
     * @return $this
     */
    public function setContactUrl($contactUrl)
    {
        $this->contact = $contactUrl;
        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        if (!$this->contactEntity) {
            $this->contactEntity = $this->getApi()->getOneResourceByUrl($this->getContactUrl());
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

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param $budget
     * @return $this
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsIr35()
    {
        return $this->isIr35;
    }

    /**
     * @param $isIr35
     * @return $this
     */
    public function setIsIr35($isIr35)
    {
        $this->isIr35 = $isIr35;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBudgetUnits()
    {
        return $this->budgetUnits;
    }

    /**
     * @param $budgetUnits
     * @return $this
     */
    public function setBudgetUnits($budgetUnits)
    {
        $this->budgetUnits = $budgetUnits;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNormalBillingRate()
    {
        return $this->normalBillingRate;
    }

    /**
     * @param $normalBillingRate
     * @return $this
     */
    public function setNormalBillingRate($normalBillingRate)
    {
        $this->normalBillingRate = $normalBillingRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHoursPerDay()
    {
        return $this->hoursPerDay;
    }

    /**
     * @param $hoursPerDay
     * @return $this
     */
    public function setHoursPerDay($hoursPerDay)
    {
        $this->hoursPerDay = $hoursPerDay;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsesProjectInvoiceSequence()
    {
        return $this->usesProjectInvoiceSequence;
    }

    /**
     * @param $usesProjectInvoiceSequence
     * @return $this
     */
    public function setUsesProjectInvoiceSequence($usesProjectInvoiceSequence)
    {
        $this->usesProjectInvoiceSequence = $usesProjectInvoiceSequence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingPeriod()
    {
        return $this->billingPeriod;
    }

    /**
     * @param $billingPeriod
     * @return $this
     */
    public function setBillingPeriod($billingPeriod)
    {
        $this->billingPeriod = $billingPeriod;
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

    /**
     * Get invoices associated with this Project
     * @return EntityCollection
     */
    public function getInvoices()
    {
        return $this->getApi()->invoice()->query(['project' => $this->getUrl()]);
    }

    public function isActive()
    {
        return $this->getStatus() == self::STATUS_ACTIVE;
    }

    public function isCancelled()
    {
        return $this->getStatus() == self::STATUS_CANCELLED;
    }

    public function isCompleted()
    {
        return $this->getStatus() == self::STATUS_COMPLETED;
    }

    public function isHidden()
    {
        return $this->getStatus() == self::STATUS_HIDDEN;
    }

    public function getTimeslips(array $filters = [])
    {
        $filters = array_merge($filters, ['project' => $this->getUrl()]);

        return $this->getApi()->timeslip()->query($filters);
    }

    public function getEstimates()
    {
        return $this->getApi()->estimate()->query([
            'project' => $this->getUrl(),
        ]);
    }
}
