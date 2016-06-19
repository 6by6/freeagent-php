<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class BankTransaction
 * @see https://dev.freeagent.com/docs/bank_transactions
 * @package SixBySix\Freeagent\Entity
 */
class BankTransaction extends AbstractEntity
{
    const API_ENTITY_NAME = 'bank_transaction';
    const API_RESOURCE_NAME = 'bank_transactions';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var double
     * @Groups({"get"})
     * @Type("double")
     */
    protected $amount;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $bankAccount;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var double
     * @Groups({"get"})
     * @Type("double")
     */
    protected $unexplainedAmount;

    /**
     * @var bool
     * @Groups({"get"})
     * @Type("boolean")
     */
    protected $isManual;

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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getBankAccount()
    {
        return $this->bankAccount;
    }

    /**
     * @return \DateTime
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return float
     */
    public function getUnexplainedAmount()
    {
        return $this->unexplainedAmount;
    }

    /**
     * @return bool
     */
    public function getIsManual()
    {
        return $this->isManual;
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
}