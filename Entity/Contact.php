<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Contact
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/contacts
 */
class Contact extends AbstractEntity
{
    const API_RESOURCE_NAME = 'contacts';
    const API_ENTITY_NAME = 'contact';

    const CHARGE_SALES_TAX_AUTO = 'Auto';
    const CHARGE_SALES_TAX_ALWAYS = 'Always';
    const CHARGE_SALES_TAX_NEVER = 'Never';

    const VIEW_ALL = 'all';
    const VIEW_ACTIVE = 'active';
    const VIEW_CLIENTS = 'clients';
    const VIEW_SUPPLIERS = 'suppliers';
    const VIEW_ACTIVE_PROJECTS = 'active_projects';
    const VIEW_COMPLETED_PROJECTS = 'completed_projects';
    const VIEW_OPEN_CLIENTS = 'open_projects';
    const VIEW_OPEN_SUPPLIERS = 'open_suppliers';
    const VIEW_HIDDEN = 'hidden';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $firstName;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $lastName;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $organisationName;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $email;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $billingEmail;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $phoneNumber;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $mobile;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $address1;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $address2;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $address3;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $town;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $region;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $postcode;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $country;

    /**
     * @var bool
     * @Groups({"update", "post", "get"})
     * @Type("boolean")
     */
    protected $contactNameOnInvoices;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $locale;

    /**
     * @var float
     * @Groups({"get"})
     * @Type("double")
     */
    protected $accountBalance;

    /**
     * @var bool
     * @Groups({"update", "post", "get"})
     * @Type("boolean")
     */
    protected $usesContactInvoiceSequence;

    /**
     * @var bool
     * @Groups({"update", "post", "get"})
     * @Type("boolean")
     */
    protected $chargeSalesTax;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $salesTaxRegistrationNumber;

    /**
     * @var integer
     * @Groups({"update", "post", "get"})
     * @Type("integer")
     */
    protected $activeProjectsCount;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $status;

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
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param $firstName
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganisationName()
    {
        return $this->organisationName;
    }

    /**
     * @param $organisationName
     * @return $this
     */
    public function setOrganisationName($organisationName)
    {
        $this->organisationName = $organisationName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBillingEmail()
    {
        return $this->billingEmail;
    }

    /**
     * @param $billingEmail
     * @return $this
     */
    public function setBillingEmail($billingEmail)
    {
        $this->billingEmail = $billingEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param $mobile
     * @return $this
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param $address1
     * @return $this
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param $address2
     * @return $this
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * @param $address3
     * @return $this
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param $town
     * @return $this
     */
    public function setTown($town)
    {
        $this->town = $town;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param $postcode
     * @return $this
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContactNameOnInvoices()
    {
        return $this->contactNameOnInvoices;
    }

    /**
     * @param $contactNameOnInvoices
     * @return $this
     */
    public function setContactNameOnInvoices($contactNameOnInvoices)
    {
        $this->contactNameOnInvoices = $contactNameOnInvoices;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAccountBalance()
    {
        return $this->accountBalance;
    }

    /**
     * @return mixed
     */
    public function getUsesContactInvoiceSequence()
    {
        return $this->usesContactInvoiceSequence;
    }

    /**
     * @param $usesContactInvoiceSequence
     * @return $this
     */
    public function setUsesContactInvoiceSequence($usesContactInvoiceSequence)
    {
        $this->usesContactInvoiceSequence = $usesContactInvoiceSequence;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChargeSalesTax()
    {
        return $this->chargeSalesTax;
    }

    /**
     * @param $chargeSalesTax
     * @return $this
     */
    public function setChargeSalesTax($chargeSalesTax)
    {
        $this->chargeSalesTax = $chargeSalesTax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSalesTaxRegistrationNumber()
    {
        return $this->salesTaxRegistrationNumber;
    }


    /**
     * @param $salesTaxRegistrationNumber
     * @return $this
     */
    public function setSalesTaxRegistrationNumber($salesTaxRegistrationNumber)
    {
        $this->salesTaxRegistrationNumber = $salesTaxRegistrationNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActiveProjectsCount()
    {
        return $this->activeProjectsCount;
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
     * Get invoices associated with this Contact
     * @return EntityCollection
     */
    public function getInvoices()
    {
        return $this->getApi()->invoice()->query(['contact' => $this->getUrl()]);
    }

    /**
     * Get projects for this client
     * @return EntityCollection
     */
    public function getProjects()
    {
        return $this->getApi()->project()->query(['contact' => $this->getUrl()]);
    }

    /**
     * @return EntityCollection
     */
    public function getEstimates()
    {
        return $this->getApi()->estimate()->query(['contact' => $this->getUrl()]);
    }
}
