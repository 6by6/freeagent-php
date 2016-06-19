<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\TaxEvent;

/**
 * Class Company
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/company
 */
class Company extends AbstractEntity
{
    const API_ENTITY_NAME = 'company';
    const API_RESOURCE_NAME = 'company';

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
    protected $name;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $subdomain;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $type;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $mileageUnits;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $companyStartDate;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $freeagentStartDate;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $firstAccountingYearEnd;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $companyRegistrationNumber;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $salesTaxRegistrationStatus;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $address1;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $address2;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $address3;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $town;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $postcode;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $country;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $contactEmail;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $contactPhone;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $website;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $businessType;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $shortDateFormat;

    /**
     * @var bool
     * @Groups({"get"})
     * @Type("boolean")
     */
    protected $ecVatReportingEnabled;

    /**
     * @var bool
     * @Groups({"get"})
     * @Type("boolean")
     */
    protected $salesTaxEffectiveDate;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $initialVatBasis;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $initiallyOnFrs;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $initialVatFrsType;


    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $vatFirstReturnPeriodEndsOn;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $salesTaxName;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $salesTaxRegistrationNumber;

    /**
     * @Groups({"get"})
     * @Type("array<float>")
     */
    protected $salesTaxRates;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $salesTaxIsValueAdded;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $supportsAutoSalesTaxOnPurchases;

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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getMileageUnits()
    {
        return $this->mileageUnits;
    }

    /**
     * @return mixed
     */
    public function getCompanyStartDate()
    {
        return $this->companyStartDate;
    }

    /**
     * @return mixed
     */
    public function getFreeagentStartDate()
    {
        return $this->freeagentStartDate;
    }

    /**
     * @return mixed
     */
    public function getFirstAccountingYearEnd()
    {
        return $this->firstAccountingYearEnd;
    }

    /**
     * @return mixed
     */
    public function getCompanyRegistrationNumber()
    {
        return $this->companyRegistrationNumber;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxRegistrationStatus()
    {
        return $this->salesTaxRegistrationStatus;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @return mixed
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @return mixed
     */
    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return mixed
     */
    public function getBusinessType()
    {
        return $this->businessType;
    }

    /**
     * @return mixed
     */
    public function getShortDateFormat()
    {
        return $this->shortDateFormat;
    }

    /**
     * @return mixed
     */
    public function getEcVatReportingEnabled()
    {
        return $this->ecVatReportingEnabled;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxEffectiveDate()
    {
        return $this->salesTaxEffectiveDate;
    }

    /**
     * @return mixed
     */
    public function getVatFirstReturnPeriodEndsOn()
    {
        return $this->vatFirstReturnPeriodEndsOn;
    }

    /**
     * @return mixed
     */
    public function getInitialVatBasis()
    {
        return $this->initialVatBasis;
    }

    /**
     * @return mixed
     */
    public function getInitiallyOnFrs()
    {
        return $this->initiallyOnFrs;
    }

    /**
     * @return mixed
     */
    public function getInitialVatFrsType()
    {
        return $this->initialVatFrsType;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxName()
    {
        return $this->salesTaxName;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxRegistrationNumber()
    {
        return $this->salesTaxRegistrationNumber;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxRates()
    {
        return $this->salesTaxRates;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxIsValueAdded()
    {
        return $this->salesTaxIsValueAdded;
    }

    /**
     * @return mixed
     */
    public function getSupportsAutoSalesTaxOnPurchases()
    {
        return $this->supportsAutoSalesTaxOnPurchases;
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

    // @todo this is cack
    public function getUpcomingTaxEvents()
    {
        /** @var string $url */
        $url = $this->getApi()->getUrl(TaxEvent::API_RESOURCE_NAME);

        /** @var array $response */
        $response = $this->getApi()->GET($url);

        /** @var array $items */
        $items = [];

        foreach ($response['timeline_items'] as $itemData) {
            $item = $this->deserialize($itemData);
            $item->setApi($this->getApi());
            $items[] = $item;
        }

        return $items;
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