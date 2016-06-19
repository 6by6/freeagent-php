<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\Entity\Contact;

/**
 * Class RecurringInvoice
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/recurring_invoices
 */
class RecurringInvoice extends AbstractEntity
{
    const API_ENTITY_NAME = 'recurring_invoice';
    const API_RESOURCE_NAME = 'recurring_invoices';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

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
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $frequency;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $nextRecursOn;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $recurringEndDate;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $recurringStatus;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $reference;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string")
     */
    protected $currency;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $exchangeRate;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $netValue;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $salesTaxValue;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double")
     */
    protected $totalValue;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean")
     */
    protected $omitHeader;

    /**
     * @var bool
     * @Groups({"post", "update", "get"})
     * @Type("boolean")
     */
    protected $alwaysShowBicAndIban;

    /**
     * @var integer
     * @Groups({"post", "update", "get"})
     * @Type("integer")
     */
    protected $paymentTermsInDays;

    /**
     * @var InvoiceItem[]
     * @Groups({"get", "post", "update"})
     * @Type("array<SixBySix\Freeagent\Entity\InvoiceItem>")
     */
    protected $invoiceItems;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return InvoiceItem[]
     */
    public function getInvoiceItems()
    {
        return $this->invoiceItems;
    }

    /**
     * @param InvoiceItem[] $invoiceItems
     * @return RecurringInvoice
     */
    public function setInvoiceItems($invoiceItems)
    {
        $this->invoiceItems = $invoiceItems;
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
     * @return RecurringInvoice
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param string $frequency
     * @return RecurringInvoice
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getNextRecursOn()
    {
        return $this->nextRecursOn;
    }

    /**
     * @param \DateTime $nextRecursOn
     * @return RecurringInvoice
     */
    public function setNextRecursOn($nextRecursOn)
    {
        $this->nextRecursOn = $nextRecursOn;
        return $this;
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
     * @return RecurringInvoice
     */
    public function setRecurringEndDate($recurringEndDate)
    {
        $this->recurringEndDate = $recurringEndDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getRecurringStatus()
    {
        return $this->recurringStatus;
    }

    /**
     * @param string $recurringStatus
     * @return RecurringInvoice
     */
    public function setRecurringStatus($recurringStatus)
    {
        $this->recurringStatus = $recurringStatus;
        return $this;
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
     * @return RecurringInvoice
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
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
     * @return RecurringInvoice
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param float $exchangeRate
     * @return RecurringInvoice
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
        return $this;
    }

    /**
     * @return float
     */
    public function getNetValue()
    {
        return $this->netValue;
    }

    /**
     * @param float $netValue
     * @return RecurringInvoice
     */
    public function setNetValue($netValue)
    {
        $this->netValue = $netValue;
        return $this;
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
     * @return RecurringInvoice
     */
    public function setSalesTaxValue($salesTaxValue)
    {
        $this->salesTaxValue = $salesTaxValue;
        return $this;
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
     * @return RecurringInvoice
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isOmitHeader()
    {
        return $this->omitHeader;
    }

    /**
     * @param boolean $omitHeader
     * @return RecurringInvoice
     */
    public function setOmitHeader($omitHeader)
    {
        $this->omitHeader = $omitHeader;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAlwaysShowBicAndIban()
    {
        return $this->alwaysShowBicAndIban;
    }

    /**
     * @param boolean $alwaysShowBicAndIban
     * @return RecurringInvoice
     */
    public function setAlwaysShowBicAndIban($alwaysShowBicAndIban)
    {
        $this->alwaysShowBicAndIban = $alwaysShowBicAndIban;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaymentTermsInDays()
    {
        return $this->paymentTermsInDays;
    }

    /**
     * @param int $paymentTermsInDays
     * @return RecurringInvoice
     */
    public function setPaymentTermsInDays($paymentTermsInDays)
    {
        $this->paymentTermsInDays = $paymentTermsInDays;
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

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }
}