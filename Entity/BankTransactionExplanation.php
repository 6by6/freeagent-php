<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\Estimate\StockItem;

/**
 * Class BankTransactionExplanation
 * @see https://dev.freeagent.com/docs/bank_transaction_explanations
 * @package SixBySix\Freeagent\Entity
 */
class BankTransactionExplanation extends AbstractEntity
{
    const API_RESOURCE_NAME = 'bank_transaction_explanations';
    const API_ENTITY_NAME = 'bank_transaction_explanation';

    /**
     * @var string
     * @Groups({"get", "update"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Accessor(getter="getBankTransactionUrl", setter="setBankTransactionUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $bankTransaction;

    /**
     * @var BankTransaction
     */
    protected $bankTransactionEntity;

    /**
     * @var string
     * @Accessor(getter="getBankAccountUrl", setter="setBankAccountUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $bankAccount;

    /**
     * @var BankAccount
     */
    protected $bankAccountEntity;

    /**
     * @var string
     * @Accessor(getter="getCategoryUrl", setter="setCategoryUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $category;

    /**
     * @var Category
     */
    protected $categoryEntity;

    /**
     * @var \DateTime
     * @Groups({"get", "post", "update"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var float
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $grossValue;

    /**
     * @var string
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $project;

    /**
     * @var Project
     */
    protected $projectEntity;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $rebillType;

    /**
     * @var float
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $rebillFactor;

    /**
     * @var Attachment
     * @Groups({"get", "post", "update"})
     * @Type("SixBySix\Freeagent\Entity\Attachment")
     */
    protected $attachment;

    /**
     * @var float
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $manualSalesTaxAmount;

    /**
     * @var float
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $foreignCurrencyValue;

    /**
     * @var string
     * @Accessor(getter="getPaidInvoiceUrl", setter="setPaidInvoiceUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $paidInvoice;

    /**
     * @var Invoice
     */
    protected $paidInvoiceEntity;

    /**
     * @var string
     * @Accessor(getter="getPaidBillUrl", setter="setPaidBillUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $paidBill;

    /**
     * @var Bill
     */
    protected $paidBillEntity;

    /**
     * @var string
     * @Accessor(getter="getPaidUserUrl", setter="setPaidUserUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $paidUser;

    /**
     * @var User
     */
    protected $paidUserEntity;

    /**
     * @var string
     * @Accessor(getter="getTransferBankAccountUrl", setter="setTransferBankAccountUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $transferBankAccount;

    /**
     * @var BankAccount
     */
    protected $transferBankAccountEntity;

    /**
     * @var string
     * @Accessor(getter="getStockItemUrl", setter="setStockItemUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $stockItem;

    /**
     * @var StockItem
     */
    protected $stockItemEntity;

    /**
     * @var integer
     * @Groups({"get", "post", "update"})
     * @Type("integer")
     */
    protected $stockAlteringQuantity;

    /**
     * @var integer
     * @Groups({"get", "post", "update"})
     * @Type("integer")
     */
    protected $assetLifeYears;

    /**
     * @var string
     * @Accessor(getter="getDisposedAssetUrl", setter="setDisposedAssetUrl")
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $disposedAsset;

    /**
     * @var CapitalAsset
     */
    protected $disposedAssetEntity;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $ecStatus;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $placeOfSupply;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $type;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getBankTransactionUrl()
    {
        return $this->bankTransaction;
    }

    /**
     * @param $bankTransaction
     * @return $this
     */
    public function setBankTransactionUrl($bankTransaction)
    {
        $this->bankTransaction = $bankTransaction;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBankAccountUrl()
    {
        return $this->bankAccount;
    }

    /**
     * @param $bankAccount
     * @return $this
     */
    public function setBankAccountUrl($bankAccount)
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryUrl()
    {
        return $this->category;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategoryUrl($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @param $datedOn
     * @return $this
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
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
     * @param $description
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
    public function getDisposedAssetUrl()
    {
        return $this->disposedAsset;
    }

    /**
     * @param $disposedAsset
     * @return $this
     */
    public function setDisposedAssetUrl($disposedAsset)
    {
        $this->disposedAsset = $disposedAsset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGrossValue()
    {
        return $this->grossValue;
    }

    /**
     * @param $grossValue
     * @return $this
     */
    public function setGrossValue($grossValue)
    {
        $this->grossValue = $grossValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProjectUrl()
    {
        return $this->project;
    }

    /**
     * @param $project
     * @return $this
     */
    public function setProjectUrl($project)
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRebillType()
    {
        return $this->rebillType;
    }

    /**
     * @param $rebillType
     * @return $this
     */
    public function setRebillType($rebillType)
    {
        $this->rebillType = $rebillType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRebillFactor()
    {
        return $this->rebillFactor;
    }

    /**
     * @param $rebillFactor
     * @return $this
     */
    public function setRebillFactor($rebillFactor)
    {
        $this->rebillFactor = $rebillFactor;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getManualSalesTaxAmount()
    {
        return $this->manualSalesTaxAmount;
    }

    /**
     * @param $manualSalesTaxAmount
     * @return $this
     */
    public function setManualSalesTaxAmount($manualSalesTaxAmount)
    {
        $this->manualSalesTaxAmount = $manualSalesTaxAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getForeignCurrencyValue()
    {
        return $this->foreignCurrencyValue;
    }

    /**
     * @param $foreignCurrencyValue
     * @return $this
     */
    public function setForeignCurrencyValue($foreignCurrencyValue)
    {
        $this->foreignCurrencyValue = $foreignCurrencyValue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaidInvoiceUrl()
    {
        return $this->paidInvoice;
    }

    /**
     * @param $paidInvoice
     * @return $this
     */
    public function setPaidInvoiceUrl($paidInvoice)
    {
        $this->paidInvoice = $paidInvoice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaidBillUrl()
    {
        return $this->paidBill;
    }

    /**
     * @param $paidBill
     * @return $this
     */
    public function setPaidBillUrl($paidBill)
    {
        $this->paidBill = $paidBill;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaidUserUrl()
    {
        return $this->paidUser;
    }

    /**
     * @param $paidUser
     * @return $this
     */
    public function setPaidUserUrl($paidUser)
    {
        $this->paidUser = $paidUser;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransferBankAccountUrl()
    {
        return $this->transferBankAccount;
    }

    /**
     * @param $transferBankAccount
     * @return $this
     */
    public function setTransferBankAccountUrl($transferBankAccount)
    {
        $this->transferBankAccount = $transferBankAccount;
        return $this;
    }

    /**
     * @return BankAccount
     */
    public function getTransferBankAccount()
    {
        if (!$this->transferBankAccountEntity) {
            $this->transferBankAccountEntity = $this->getApi()->getOneResourceByUrl($this->getTransferBankAccountUrl());
        }

        return $this->transferBankAccountEntity;
    }

    /**
     * @return mixed
     */
    public function getStockItemUrl()
    {
        return $this->stockItem;
    }

    /**
     * @param $stockItem
     * @return $this
     */
    public function setStockItemUrl($stockItem)
    {
        $this->stockItem = $stockItem;
        return $this;
    }

    /**
     * @return StockItem
     */
    public function getStockItem()
    {
        if (!$this->stockItemEntity) {
            $this->stockItemEntity = $this->getApi()->getOneResourceByUrl($this->getStockItemUrl());
        }

        return $this->stockItemEntity;
    }

    /**
     * @return mixed
     */
    public function getStockAlteringQuantity()
    {
        return $this->stockAlteringQuantity;
    }

    /**
     * @param $stockAlteringQuantity
     * @return $this
     */
    public function setStockAlteringQuantity($stockAlteringQuantity)
    {
        $this->stockAlteringQuantity = $stockAlteringQuantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAssetLifeYears()
    {
        return $this->assetLifeYears;
    }

    /**
     * @param $assetLifeYears
     * @return $this
     */
    public function setAssetLifeYears($assetLifeYears)
    {
        $this->assetLifeYears = $assetLifeYears;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisposedAsset()
    {
        return $this->disposedAsset;
    }

    /**
     * @param $disposedAsset
     * @return $this
     */
    public function setDisposedAsset($disposedAsset)
    {
        $this->disposedAsset = $disposedAsset;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEcStatus()
    {
        return $this->ecStatus;
    }

    /**
     * @param $ecStatus
     * @return $this
     */
    public function setEcStatus($ecStatus)
    {
        $this->ecStatus = $ecStatus;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlaceOfSupply()
    {
        return $this->placeOfSupply;
    }

    /**
     * @param $placeOfSupply
     * @return $this
     */
    public function setPlaceOfSupply($placeOfSupply)
    {
        $this->placeOfSupply = $placeOfSupply;
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

    /**
     * @return BankTransaction
     */
    public function getBankTransaction()
    {
        if (!$this->bankTransactionEntity) {
            $this->bankTransactionEntity = $this->getApi()->getOneResourceByUrl($this->getBankTransactionUrl());
        }

        return $this->bankTransactionEntity;
    }

    /**
     * @param BankTransaction $bankTransactionEntity
     */
    public function setBankTransaction(BankTransaction $bankTransactionEntity)
    {
        $this->bankTransactionEntity = $bankTransactionEntity;
    }

    /**
     * @return BankAccount
     */
    public function getBankAccount()
    {
        if (!$this->bankAccountEntity) {
            $this->bankAccountEntity = $this->getApi()->getOneResourceByUrl($this->getBankAccountUrl());
        }

        return $this->bankAccountEntity;
    }

    /**
     * @param BankAccount $bankAccountEntity
     */
    public function setBankAccount(BankAccount $bankAccountEntity)
    {
        $this->bankAccountEntity = $bankAccountEntity;
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
     * @param Category $categoryEntity
     */
    public function setCategory(Category $categoryEntity)
    {
        $this->categoryEntity = $categoryEntity;
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
     * @param Project $projectEntity
     */
    public function setProject(Project $projectEntity)
    {
        $this->projectEntity = $projectEntity;
    }

    /**
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachmentEntity
     */
    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @return Invoice
     */
    public function getPaidInvoice()
    {
        if (!$this->paidInvoiceEntity) {
            $this->paidInvoiceEntity = $this->getApi()->getOneResourceByUrl($this->getPaidInvoiceUrl());
        }

        return $this->paidInvoiceEntity;
    }

    /**
     * @param Invoice $paidInvoiceEntity
     */
    public function setPaidInvoice(Invoice $paidInvoiceEntity)
    {
        $this->paidInvoiceEntity = $paidInvoiceEntity;
    }

    /**
     * @return Bill
     */
    public function getPaidBill()
    {
        if (!$this->paidBillEntity) {
            $this->paidBillEntity = $this->getApi()->getOneResourceByUrl($this->getPaidBillUrl());
        }

        return $this->paidBillEntity;
    }

    /**
     * @param Bill $paidBillEntity
     */
    public function setPaidBill(Bill $paidBillEntity)
    {
        $this->paidBillEntity = $paidBillEntity;
    }

    /**
     * @return User
     */
    public function getPaidUser()
    {
        if (!$this->paidUserEntity) {
            $this->paidUserEntity = $this->getApi()->getOneResourceByUrl($this->getPaidUserUrl());
        }

        return $this->paidUserEntity;
    }

    /**
     * @param User $paidUserEntity
     */
    public function setPaidUser(User $paidUserEntity)
    {
        $this->paidUserEntity = $paidUserEntity;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
