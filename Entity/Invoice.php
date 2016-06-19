<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

use SixBySix\Freeagent\Exception;
use SixBySix\Freeagent\OAuth2\Api;

/**
 * Class Invoice
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/invoices
 */
class Invoice extends AbstractEntity
{
    const API_RESOURCE_NAME = 'invoices';
    const API_ENTITY_NAME = 'invoice';

    const VIEW_ALL = 'all'; // (default)
    const VIEW_RECENT_OPEN_OR_OVERDUE = 'recent_open_or_overdue';
    const VIEW_OPEN_OR_OVERDUE = 'open_or_overdue';
    const VIEW_DRAFT = 'draft';
    const VIEW_SCHEDULED_TO_EMAIL = 'scheduled_to_email';
    const VIEW_THANK_YOU_EMAIL = 'thank_you_emails';
    const VIEW_REMINDER_EMAIL = 'reminder_emails';
    const VIEW_LAST_X_MONTHS = 'last_%d_months';

    const TRANSITION_SENT = 'mark_as_sent';
    const TRANSITION_SCHEDULED = 'mark_as_scheduled';
    const TRANSITION_DRAFT = 'mark_as_draft';
    const TRANSITION_CANCELLED = 'mark_as_cancelled';

    const STATUS_DRAFT = 'Draft';
    const STATUS_OPEN = 'Open';
    const STATUS_SCHEDULED = 'Scheduled To Email';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
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
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $project;

    /**
     * @var Project
     */
    protected $projectEntity;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $dueOn;

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
    protected $currency;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $exchangeRate;

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
    protected $totalValue;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $paidValue;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $dueValue;

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
    protected $comments;

    /**
     * @var float
     * @Groups({"get", "update", "post"})
     * @Type("boolean")
     */
    protected $omitHeader;

    /**
     * @var bool
     * @Groups({"get", "update", "post"})
     * @Type("boolean")
     */
    protected $alwaysShowBicAndIban;

    /**
     * @var bool
     * @Groups({"get", "update", "post"})
     * @Type("boolean")
     */
    protected $sendThankYouEmails;

    /**
     * @var bool
     * @Groups({"get", "update", "post"})
     * @Type("boolean")
     */
    protected $sendReminderEmails;

    /**
     * @var bool
     * @Groups({"get", "update", "post"})
     * @Type("boolean")
     */
    protected $sendNewInvoiceEmails;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $bankAccount;

    /**
     * @var BankAccount
     */
    protected $bankAccountEntity;

    /**
     * @var integer
     * @Groups({"get", "update", "post"})
     * @Type("integer")
     */
    protected $paymentTermsInDays;

    /**
     * @var string
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $ecStatus;

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
     * @var InvoiceItem[]
     * @Groups({"get", "post", "update"})
     * @Type("array<SixBySix\Freeagent\Entity\InvoiceItem>")
     */
    protected $invoiceItems;

    /**
     * @var string
     * @Groups({"get","post","update"})
     * @Type("string")
     */
    protected $placeOfSupply;

    /**
     * @var \DateTime
     * @Groups({"get","update","post"})
     * @Type("DateTime<'Y-m-d\TH:i:sO'>")
     */
    protected $writtenOffDate;


    public function __construct()
    {
        $this->setDatedOn(new \DateTime());
        $this->setPaymentTermsInDays(0);
    }

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
    public function getContactUrl()
    {
        return $this->contact;
    }

    /**
     * @param string $contact
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
     * @return string
     */
    public function getProjectUrl()
    {
        return $this->project;
    }

    /**
     * @param string $project
     * @return $this
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
     * @return \DateTime
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @param \DateTime $datedOn
     * @return $this
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
        return $this;
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
     * @return $this
     */
    public function setDueOn($dueOn)
    {
        $this->dueOn = $dueOn;
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
     * @return $this
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
     * @return $this
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
     * @return $this
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
     * @return $this
     */
    public function setNetValue($netValue)
    {
        $this->netValue = $netValue;
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
     * @return $this
     */
    public function setTotalValue($totalValue)
    {
        $this->totalValue = $totalValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getPaidValue()
    {
        return $this->paidValue;
    }

    /**
     * @param float $paidValue
     * @return $this
     */
    public function setPaidValue($paidValue)
    {
        $this->paidValue = $paidValue;
        return $this;
    }

    /**
     * @return float
     */
    public function getDueValue()
    {
        return $this->dueValue;
    }

    /**
     * @param float $dueValue
     * @return $this
     */
    public function setDueValue($dueValue)
    {
        $this->dueValue = $dueValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
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
     * @return $this
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return string
     */
    public function getOmitHeader()
    {
        return $this->omitHeader;
    }

    /**
     * @param string $omitHeader
     * @return $this
     */
    public function setOmitHeader($omitHeader)
    {
        $this->omitHeader = $omitHeader;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlwaysShowBicAndIban()
    {
        return $this->alwaysShowBicAndIban;
    }

    /**
     * @param string $alwaysShowBicAndIban
     * @return $this
     */
    public function setAlwaysShowBicAndIban($alwaysShowBicAndIban)
    {
        $this->alwaysShowBicAndIban = $alwaysShowBicAndIban;
        return $this;
    }

    /**
     * @return string
     */
    public function getSendThankYouEmails()
    {
        return $this->sendThankYouEmails;
    }

    /**
     * @param string $sendThankYouEmails
     * @return $this
     */
    public function setSendThankYouEmails($sendThankYouEmails)
    {
        $this->sendThankYouEmails = $sendThankYouEmails;
        return $this;
    }

    /**
     * @return string
     */
    public function getSendReminderEmails()
    {
        return $this->sendReminderEmails;
    }

    /**
     * @param string $sendReminderEmails
     * @return $this
     */
    public function setSendReminderEmails($sendReminderEmails)
    {
        $this->sendReminderEmails = $sendReminderEmails;
        return $this;
    }

    /**
     * @return string
     */
    public function getSendNewInvoiceEmails()
    {
        return $this->sendNewInvoiceEmails;
    }

    /**
     * @param bool $sendNewInvoiceEmails
     * @return $this
     */
    public function setSendNewInvoiceEmails($sendNewInvoiceEmails)
    {
        $this->sendNewInvoiceEmails = $sendNewInvoiceEmails;
        return $this;
    }

    /**
     * @return string
     */
    public function getBankAccountUrl()
    {
        return $this->bankAccount;
    }

    /**
     * @param string $bankAccount
     * @return $this
     */
    public function setBankAccountUrl($bankAccount)
    {
        $this->bankAccount = $bankAccount;
        return $this;
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
     * @param BankAccount $bankAccount
     * @return $this
     */
    public function setBankAccount(BankAccount $bankAccount)
    {
        $this->bankAccountEntity = $bankAccount;
        $this->bankAccount = $bankAccount->getUrl();
        return $this;
    }

    /**
     * @return integer
     */
    public function getPaymentTermsInDays()
    {
        return $this->paymentTermsInDays;
    }

    /**
     * @param integer $paymentTermsInDays
     * @return $this
     */
    public function setPaymentTermsInDays($paymentTermsInDays)
    {
        $this->paymentTermsInDays = $paymentTermsInDays;
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
     * @param $ecStatus
     * @return $this
     */
    public function setEcStatus($ecStatus)
    {
        $this->ecStatus = $ecStatus;
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

    /**
     * @return InvoiceItem[]
     */
    public function getInvoiceItems()
    {
        return $this->invoiceItems;
    }

    /**
     * @param Invoice|array $invoiceItem
     * @param null|integer $position
     * @return $this
     * @throws Exception
     */
    public function addInvoiceItem($invoiceItem, $position = null)
    {
        if (is_array($invoiceItem)) {
            /** @var InvoiceItem $invoiceItem */
            $invoiceItem = InvoiceItem::deserialize($invoiceItem);
        } elseif (!$invoiceItem instanceof InvoiceItem) {
            throw new Exception(
                sprintf(
                    'Invoice::addInvoiceItem() expects instance of ' .
                    '\SixBySix\Freeagent\Entity\InvoiceItem or array, received "%s"',
                    gettype($invoiceItem)
                )
            );
        }

        $invoiceItem->setPosition($position);
        $invoiceItem->setDestroy(false);

        $this->invoiceItems[] = $invoiceItem;

        return $this;
    }

    /**
     * @param Invoice|integer $invoiceItem
     * @throws Exception
     * @return $this
     */
    public function removeInvoiceItem($invoiceItem)
    {
        if (is_numeric($invoiceItem) && sizeof($this->invoiceItems) <= $invoiceItem) {
            /** @var integer $idx */
            $idx = $invoiceItem;
            /** @var InvoiceItem $invoiceItem */
            $invoiceItem = $this->invoiceItems[$idx];
        } elseif (!$invoiceItem instanceof InvoiceItem) {
            throw new Exception(
                sprintf(
                    'Invoice::removeInvoiceItem() expects instance of ' .
                    '\SixBySix\Freeagent\Entity\InvoiceItem or array, received "%s"',
                    gettype($invoiceItem)
                )
            );
        }
        $invoiceItem->setDestroy(true);
        return $this;
    }

    /**
     * @param InvoiceItem[] $invoiceItems
     * @return $this
     */
    public function setInvoiceItems($invoiceItems)
    {
        $this->invoiceItems = $invoiceItems;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    /**
     *
     */
    public function markAsSent()
    {
        $this->sendTransitionRequest(self::TRANSITION_SENT);

    }

    /**
     *
     */
    public function markAsScheduled()
    {
        $this->sendTransitionRequest(self::TRANSITION_SCHEDULED);
    }

    /**
     *
     */
    public function markAsDraft()
    {
        $this->sendTransitionRequest(self::TRANSITION_DRAFT);
    }

    /**
     *
     */
    public function markAsCancelled()
    {
        $this->sendTransitionRequest(self::TRANSITION_CANCELLED);
    }

    /**
     * @return bool
     */
    public function isDraft()
    {
        return $this->getStatus() == self::STATUS_DRAFT;
    }

    /**
     * @return bool
     */
    public function isOpen()
    {
        return $this->getStatus() == self::STATUS_OPEN;
    }

    /**
     * @return bool
     */
    public function isScheduled()
    {
        return $this->getStatus() == self::STATUS_SCHEDULED;
    }

    /**
     * @return \string[]
     */
    public function getDefaultQueryParams()
    {
        /** @var string[] $params */
        $params = parent::getDefaultQueryParams();
        $params['nested_invoice_items'] = true;

        return $params;
    }

    /**
     * @param $transition
     */
    protected function sendTransitionRequest($transition)
    {
        /** @var string $url */
        $url = sprintf('%s/transitions/%s', $this->getUrl(), $transition);

        /** @var string[] $response */
        $response = $this->getApi()->PUT($url);
    }

    /**
     * @return string
     */
    public function getEstimates()
    {
        return $this->getApi()->estimate()->query([
            'invoice' => $this->getUrl(),
        ]);
    }
}
