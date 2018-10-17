<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Expense
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/expenses
 */
class Expense extends AbstractEntity
{
    const API_ENTITY_NAME = 'expense';
    const API_RESOURCE_NAME = 'expenses';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

    /**
     * @Accessor(getter="getUserUrl", setter="setUserUrl")
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $user;

    /**
     * @var User
     */
    protected $userEntity;

    /**
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $project;

    /**
     * @var Project
     */
    protected $projectEntity;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $currency;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $receiptReference;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $grossValue;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $nativeGrossValue;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $salesTaxRate;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $description;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

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
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean");
     */
    protected $recurring;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $manualSalesTaxAmount;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $rebillType;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $rebillFactor;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $ecStatus;

    /**
     * @var Attachment
     * @Groups({"get", "post", "update"})
     * @Type("SixBySix\Freeagent\Entity\Attachment")
     */
    protected $attachment;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $mileage;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $vehicleType;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $engineType;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $engineSize;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean");
     */
    protected $reclaimMileage;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $reclaimMileageRate;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $rebillMileageRate;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean");
     */
    protected $haveVatReceipt;

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
     * @return string
     */
    public function getUserUrl()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Expense
     */
    public function setUserUrl($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        if (!$this->userEntity) {
            $this->userEntity = $this->getApi()->getOneResourceByUrl($this->getUserUrl());
        }

        return $this->userEntity;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->userEntity = $user;
        $this->user = $user->getUrl();
        return $this;
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
     * @return Expense
     */
    public function setProjectUrl($project)
    {
        $this->project = $project;
        return $this;
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
     * @param Project $project
     * @return $this
     */
    public function setProject(Project $project)
    {
        $this->projectEntity = $project;
        $this->project = $project->getUrl();
        return $this;
    }
    
    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     * @return Expense
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptReference()
    {
        return $this->receiptReference;
    }

    /**
     * @param string $receiptReference
     * @return Expense
     */
    public function setReceiptReference($receiptReference)
    {
        $this->receiptReference = $receiptReference;
        return $this;
    }

    /**
     * @return float
     */
    public function getGrossValue()
    {
        return $this->grossValue;
    }

    /**
     * @param float $grossValue
     * @return Expense
     */
    public function setGrossValue($grossValue)
    {
        $this->grossValue = $grossValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getNativeGrossValue()
    {
        return $this->nativeGrossValue;
    }

    /**
     * @param float $nativeGrossValue
     * @return Expense
     */
    public function setNativeGrossValue($nativeGrossValue)
    {
        $this->nativeGrossValue = $nativeGrossValue;
        return $this;
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
     * @return Expense
     */
    public function setSalesTaxRate($salesTaxRate)
    {
        $this->salesTaxRate = $salesTaxRate;
        return $this;
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
     * @return Expense
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
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
     * @return Expense
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
        return $this;
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
     * @return Expense
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
     * @return boolean
     */
    public function isRecurring()
    {
        return $this->recurring;
    }

    /**
     * @param boolean $recurring
     * @return Expense
     */
    public function setRecurring($recurring)
    {
        $this->recurring = $recurring;
        return $this;
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
     * @return Expense
     */
    public function setManualSalesTaxAmount($manualSalesTaxAmount)
    {
        $this->manualSalesTaxAmount = $manualSalesTaxAmount;
        return $this;
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
     * @return Expense
     */
    public function setRebillType($rebillType)
    {
        $this->rebillType = $rebillType;
        return $this;
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
     * @return Expense
     */
    public function setRebillFactor($rebillFactor)
    {
        $this->rebillFactor = $rebillFactor;
        return $this;
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
     * @return Expense
     */
    public function setEcStatus($ecStatus)
    {
        $this->ecStatus = $ecStatus;
        return $this;
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
     * @return Expense
     */
    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * @return float
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param float $mileage
     * @return Expense
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * @return string
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * @param string $vehicleType
     * @return Expense
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngineType()
    {
        return $this->engineType;
    }

    /**
     * @param string $engineType
     * @return Expense
     */
    public function setEngineType($engineType)
    {
        $this->engineType = $engineType;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngineSize()
    {
        return $this->engineSize;
    }

    /**
     * @param string $engineSize
     * @return Expense
     */
    public function setEngineSize($engineSize)
    {
        $this->engineSize = $engineSize;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isReclaimMileage()
    {
        return $this->reclaimMileage;
    }

    /**
     * @param boolean $reclaimMileage
     * @return Expense
     */
    public function setReclaimMileage($reclaimMileage)
    {
        $this->reclaimMileage = $reclaimMileage;
        return $this;
    }

    /**
     * @return float
     */
    public function getReclaimMileageRate()
    {
        return $this->reclaimMileageRate;
    }

    /**
     * @param float $reclaimMileageRate
     * @return Expense
     */
    public function setReclaimMileageRate($reclaimMileageRate)
    {
        $this->reclaimMileageRate = $reclaimMileageRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getRebillMileageRate()
    {
        return $this->rebillMileageRate;
    }

    /**
     * @param float $rebillMileageRate
     * @return Expense
     */
    public function setRebillMileageRate($rebillMileageRate)
    {
        $this->rebillMileageRate = $rebillMileageRate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isHaveVatReceipt()
    {
        return $this->haveVatReceipt;
    }

    /**
     * @param boolean $haveVatReceipt
     * @return Expense
     */
    public function setHaveVatReceipt($haveVatReceipt)
    {
        $this->haveVatReceipt = $haveVatReceipt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
