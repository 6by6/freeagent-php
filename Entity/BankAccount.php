<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use SixBySix\Freeagent\Exception;

/**
 * Class BankAccount
 * @see https://dev.freeagent.com/docs/bank_accounts
 * @package SixBySix\Freeagent\Entity
 */
class BankAccount extends AbstractEntity
{
    const API_RESOURCE_NAME = 'bank_accounts';
    const API_ENTITY_NAME = 'bank_account';

    const TYPE_STANDARD = 'StandardBankAccount';
    const TYPE_PAYPAL = 'PaypalAccount';
    const TYPE_CREDIT_CARD = 'CreditCardAccount';

    const STATEMENT_FILENAME = 'filename';
    const STATEMENT_OFX = 'ofx';
    const STATEMENT_CSV = 'csv';
    const STATEMENT_QIF = 'qif';

    /**
     * @var string
     * @Groups({"get", "update"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var double
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $openingBalance;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $type;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $name;

    /**
     * @var bool
     * @Groups({"get", "post", "update"})
     * @Type("boolean")
     */
    protected $isPersonal;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $currency;

    /**
     * @var double
     * @Groups({"get", "post", "update"})
     * @Type("double")
     */
    protected $currentBalance;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $accountNumber;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $sortCode;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $secondarySortCode;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $iban;

    /**
     * @var string
     * @Groups({"get", "post", "update"})
     * @Type("string")
     */
    protected $bic;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $latestActivityDate;

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
     * @return float
     */
    public function getOpeningBalance()
    {
        return $this->openingBalance;
    }

    /**
     * @param $openingBalance
     * @return $this
     */
    public function setOpeningBalance($openingBalance)
    {
        $this->openingBalance = $openingBalance;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
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
     * @return bool
     */
    public function getIsPersonal()
    {
        return $this->isPersonal;
    }

    /**
     * @param bool $isPersonal
     * @return $this
     */
    public function setIsPersonal($isPersonal)
    {
        $this->isPersonal = (bool) $isPersonal;
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
     * @return double
     */
    public function getCurrentBalance()
    {
        return $this->currentBalance;
    }

    /**
     * @param double $currentBalance
     * @return $this
     */
    public function setCurrentBalance($currentBalance)
    {
        $this->currentBalance = $currentBalance;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * @param string $accountNumber
     * @return $this
     */
    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortCode()
    {
        return $this->sortCode;
    }

    /**
     * @param string $sortCode
     * @return $this
     */
    public function setSortCode($sortCode)
    {
        $this->sortCode = $sortCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecondarySortCode()
    {
        return $this->secondarySortCode;
    }

    /**
     * @param string $secondarySortCode
     * @return $this
     */
    public function setSecondarySortCode($secondarySortCode)
    {
        $this->secondarySortCode = $secondarySortCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     * @return $this
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     * @return $this
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLatestActivityDate()
    {
        return $this->latestActivityDate;
    }


    /**
     * @param \DateTime $latestActivityDate
     * @return $this
     */
    public function setLatestActivityDate(\DateTime $latestActivityDate)
    {
        $this->latestActivityDate = $latestActivityDate;
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
     * @param $file
     * @param string $dataFormat
     * @throws Exception
     */
    public function uploadStatement($file, $dataFormat = self::STATEMENT_FILENAME)
    {
        /** @var string $url */
        $url = $this->getApi()->getUrl(
            $this->getApi()->bankTransaction()->getApiResourceName() . '/statement',
            ['bank_account' => $this->getId()]
        );

        /** @var string $data */
        $data = '';

        if ($dataFormat == self::STATEMENT_FILENAME) {
            $data = file_get_contents($file);
            if (!$data) {
                throw new Exception(
                    sprintf('Unable to upload %s to bank account', $file)
                );
            }
        } elseif (in_array($dataFormat, [self::STATEMENT_OFX, self::STATEMENT_CSV, self::STATEMENT_QIF])) {
            $data = $file;
        }

        $this->getApi()->POST($url, http_build_query(['statement' => $data]), [
            'Content-Type' => 'application/x-www-form-urlencoded',
        ]);
    }

    public function getTransactions()
    {
        return $this->getApi()->bankTransaction()->query([
            'bank_account' => $this->getUrl(),
        ]);
    }

    public function getTransactionExplanations()
    {
        return $this->getApi()->bankTransactionExplanations()->query([
            'bank_account' => $this->getUrl(),
        ]);
    }
}