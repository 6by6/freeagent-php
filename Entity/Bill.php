<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Bill
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/bills
 */
class Bill extends AbstractEntity
{
    const API_RESOURCE_NAME = 'bills';
    const API_ENTITY_NAME = 'bill';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $project;

    /**
     * @var Project
     */
    protected $projectEntity;

    /**
     * @var string
     * @Accessor(getter="getContactUrl", setter="setContactUrl")
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $contact;

    /**
     * @var Contact
     */
    protected $contactEntity;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $reference;

    /**
     * @var \DateTime
     * @Groups({"get","post","update"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var \DateTime
     * @Groups({"get","post","update"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $dueOn;

    /**
     * @var string
     * @Accessor(getter="getCategoryUrl", setter="setCategoryUrl")
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $category;

    /**
     * @var Category
     */
    protected $categoryEntity;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $comments;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $depreciationSchedule;

    /**
     * @var float
     * @Groups({"get","post","update"})
     * @Type("double")
     */
    protected $totalValue ;

    /**
     * @var float
     * @Groups({"get","post","update"})
     * @Type("double")
     */
    protected $salesTaxValue;

    /**
     * @var float
     * @Groups({"get","post","update"})
     * @Type("double")
     */
    protected $salesTaxRate ;

    /**
     * @var float
     * @Groups({"get","post","update"})
     * @Type("double")
     */
    protected $manualSalesTaxAmount;

    /**
     * @var float
     * @Groups({"get","post","update"})
     * @Type("double")
     */
    protected $secondSalesTaxRate;

    /**
     * @var bool
     * @Groups({"get","post","update"})
     * @Type("boolean")
     */
    protected $recurring;

    /**
     * @var \DateTime
     * @Groups({"get","post","update"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $recurringEndDate;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $rebillType;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $rebillFactor;

    /**
     * @var string
     * @Accessor(getter="getRebillToProjectUrl", setter="setRebillToProjectUrl")
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $rebillToProject;

    /**
     * @var Project
     */
    protected $rebillToProjectEntity;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $ecStatus;

    /**
     * @var Attachment
     * @Group({"get", "post", "update"})
     * @Type("SixBySix\Freeagent\Entity\Attachment")
     */
    protected $attachment;


    /**
     * @var string
     * @Accessor(getter="getRebilledOnInvoiceItemUrl", setter="setRebilledOnInvoiceItemUrl")
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $rebilledOnInvoiceItem;

    /**
     * @var InvoiceItem
     */
    protected $rebilledOnInvoiceItemEntity;

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
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getProjectUrl()
    {
        return $this->project;
    }

    /**
     * @param string $project
     */
    public function setProjectUrl($project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        if (!$this->projectEntity) {
            $this->projectEntity = $this->getApi()->getOneResourceByUrl($this->getProjectUrl());
        }
        return $this->projectEntity;
    }

    /**
     * @return string
     */
    public function getContactUrl()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     */
    public function setContactUrl($contact)
    {
        $this->contact = $contact;
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
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return \DateTime
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @param \DateTime $datedOn
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
    }

    /**
     * @return \DateTime
     */
    public function getDueOn()
    {
        return $this->dueOn;
    }

    /**
     * @param \DateTime $dueOn
     */
    public function setDueOn($dueOn)
    {
        $this->dueOn = $dueOn;
    }

    /**
     * @return string
     */
    public function getCategoryUrl()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategoryUrl($category)
    {
        $this->category = $category;
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
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getDepreciationSchedule()
    {
        return $this->depreciationSchedule;
    }

    /**
     * @param string $depreciationSchedule
     */
    public function setDepreciationSchedule($depreciationSchedule)
    {
        $this->depreciationSchedule = $depreciationSchedule;
    }

    /**
     * @return float
     */
    public function getTotalValue()
    {
        return $this->totalValue;
    }

    /**
     * @param float $totalValue
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
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
     * @return float
     */
    public function getSalesTaxRate()
    {
        return $this->salesTaxRate;
    }

    /**
     * @param float $salesTaxRate
     */
    public function setSalesTaxRate($salesTaxRate)
    {
        $this->salesTaxRate = $salesTaxRate;
    }

    /**
     * @return float
     */
    public function getManualSalesTaxAmount()
    {
        return $this->manualSalesTaxAmount;
    }

    /**
     * @param float $manualSalesTaxAmount
     */
    public function setManualSalesTaxAmount($manualSalesTaxAmount)
    {
        $this->manualSalesTaxAmount = $manualSalesTaxAmount;
    }

    /**
     * @return float
     */
    public function getSecondSalesTaxRate()
    {
        return $this->secondSalesTaxRate;
    }

    /**
     * @param float $secondSalesTaxRate
     */
    public function setSecondSalesTaxRate($secondSalesTaxRate)
    {
        $this->secondSalesTaxRate = $secondSalesTaxRate;
    }

    /**
     * @return boolean
     */
    public function isRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param boolean $recurring
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
    }

    /**
     * @return \DateTime
     */
    public function getRecurringEndDate()
    {
        return $this->recurringEndDate;
    }

    /**
     * @param \DateTime $recurringEndDate
     */
    public function setRecurringEndDate($recurringEndDate)
    {
        $this->recurringEndDate = $recurringEndDate;
    }

    /**
     * @return string
     */
    public function getRebillType()
    {
        return $this->rebillType;
    }

    /**
     * @param string $rebillType
     */
    public function setRebillType($rebillType)
    {
        $this->rebillType = $rebillType;
    }

    /**
     * @return string
     */
    public function getRebillFactor()
    {
        return $this->rebillFactor;
    }

    /**
     * @param string $rebillFactor
     */
    public function setRebillFactor($rebillFactor)
    {
        $this->rebillFactor = $rebillFactor;
    }

    /**
     * @return string
     */
    public function getRebillToProjectUrl()
    {
        return $this->rebillToProject;
    }

    /**
     * @param string $rebillToProject
     */
    public function setRebillToProjectUrl($rebillToProject)
    {
        $this->rebillToProject = $rebillToProject;
    }

    /**
     * @return Project
     */
    public function getRebillToProject()
    {
        if (!$this->rebillToProjectEntity) {
            $this->rebillToProjectEntity = $this->getApi()->getOneResourceByUrl(
                $this->getRebillToProjectUrl()
            );
        }

        return $this->rebillToProjectEntity;
    }

    /**
     * @return string
     */
    public function getEcStatus()
    {
        return $this->ecStatus;
    }

    /**
     * @param string $ecStatus
     */
    public function setEcStatus($ecStatus)
    {
        $this->ecStatus = $ecStatus;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment
     */
    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @return string
     */
    public function getRebilledOnInvoiceItemUrl()
    {
        return $this->rebilledOnInvoiceItem;
    }

    /**
     * @param string $rebilledOnInvoiceItem
     */
    public function setRebilledOnInvoiceItemUrl($rebilledOnInvoiceItem)
    {
        $this->rebilledOnInvoiceItem = $rebilledOnInvoiceItem;
    }

    /**
     * @return InvoiceItem
     */
    public function getRebilledOnInvoiceItem()
    {
        if (!$this->rebilledOnInvoiceItemEntity) {
            $this->rebilledOnInvoiceItemEntity = $this->getApi()->getOneResourceByUrl(
                $this->getRebilledOnInvoiceItemUrl()
            );
        }

        return $this->rebilledOnInvoiceItemEntity;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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