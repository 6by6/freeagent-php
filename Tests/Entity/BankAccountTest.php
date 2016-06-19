<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\BankAccount;
use SixBySix\Freeagent\Iso\Currency;

class BankAccountTest extends AbstractEntityTest
{
    protected static $bankAccountUrl;

    public function getApiMethodName()
    {
        return 'bankAccount';
    }

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\BankAccount';
    }

    /**
     * @test
     */
    public function createOne()
    {
        /** @var BankAccount $bankAccount */
        $bankAccount = $this->api->bankAccount()
            ->setName('Company Account')
            ->setAccountNumber('01234567')
            ->setCurrency(Currency::CODE_GBP)
            ->setOpeningBalance(100)
            ->save();

        self::$bankAccountUrl = $bankAccount->getUrl();
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        /** @var BankAccount $bankAccount */
        $bankAccount = $this->api->getOneResourceByUrl(self::$bankAccountUrl);
        $this->assertEquals($bankAccount->getUrl(), self::$bankAccountUrl);
    }

    /**
     * @test
     * @dataProvider updateOneProvider
     * @depends getOne
     * @param $data
     */
    public function updateOne(array $data)
    {
        /** @var BankAccount $bankAccount */
        $bankAccount = $this->api->bankAccount()->getByUrl(self::$bankAccountUrl);

        foreach ($data as $method => $value) {
            $bankAccount->{"set{$method}"}($value);
        }

        $bankAccount->save();

        $bankAccount = $this->api->bankAccount()->getByUrl(self::$bankAccountUrl);
        foreach ($data as $method => $value) {
            $this->assertEquals($value, $bankAccount->{"get{$method}"}());
        }
    }


    /**
     * @test
     * @depends getOne
     * @expectedException \SixBySix\Freeagent\Exception
     * @expectedExceptionMessage Resource not found
     */
    public function deleteOne()
    {
        /** @var BankAccount $bankAccount */
        $bankAccount = $this->api->bankAccount()->getByUrl(self::$bankAccountUrl);
        $bankAccount->delete();

        $this->api->bankAccount()->getByUrl(self::$bankAccountUrl);
    }

    /**
     * @test
     * @depends deleteOne
     * @dataProvider uploadStatementProvider
     * @param $data
     */
    public function uploadStatement(array $data)
    {
        /** @var BankAccount $bankAccount */
        $bankAccount = $this->api->bankAccount()
            ->setName('Embezzlement Depo')
            ->setType(BankAccount::TYPE_STANDARD)
            ->setOpeningBalance(0.00)
            ->save();

        if (isset($data['filename'])) {
            $bankAccount->uploadStatement($data['filename']);
        } elseif (isset($data['format']) && isset($data['data'])) {
            $bankAccount->uploadStatement($data['data'], $data['format']);
        }

        // tests
        $bankAccount = $this->api->bankAccount()->getByUrl($bankAccount->getUrl());

        $bankAccount->delete();
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    "url" => "https://api.freeagent.com/v2/bank_accounts/1",
                    "opening_balance" => "0.0",
                    "type" => "StandardBankAccount",
                    "name" => "Default bank account",
                    "is_personal" => false,
                    "currency" => "GBP",
                    "current_balance" => "0.0",
                    "updated_at" => "2016-05-17T13:55:28.000Z",
                    "created_at" => "2014-05-06T12:41:06.000Z",
                ],
                [
                    "getUrl" => "https://api.freeagent.com/v2/bank_accounts/1",
                    "getOpeningBalance" => "0.0",
                    "getType" => "StandardBankAccount",
                    "getName" => "Default bank account",
                    "getIsPersonal" => false,
                    "getCurrency" => "GBP",
                    "getCurrentBalance" => "0.0",
                ]
            ]
        ];
    }

    public function updateOneProvider()
    {
        return [
            [
                [
                    'Name' => "Bank Account #2",
                    'Type' => BankAccount::TYPE_PAYPAL,
                    'IsPersonal' => true,
                    'Currency' => Currency::CODE_EUR,
                ]
            ]
        ];
    }

    public function uploadStatementProvider()
    {
        /** @var string $statementsDir */
        $statementsDir = __DIR__ . DIRECTORY_SEPARATOR . 'bank_statements';

        /** @var string $csvFilename */
        $csvFilename = $statementsDir . DIRECTORY_SEPARATOR . 'statement.csv';
        /** @var string $csvData */
        $csvData = file_get_contents($csvFilename);

        /** @var string $ofxFilename */
        $ofxFilename = $statementsDir . DIRECTORY_SEPARATOR . 'statement.ofx';
        /** @var string $ofxData */
        $ofxData = file_get_contents($ofxFilename);

        /** @var string $qifFilename */
        $qifFilename = $statementsDir . DIRECTORY_SEPARATOR . 'statement.qif';
        /** @var string $qifData */
        $qifData = file_get_contents($qifFilename);

        return [
            [['filename' => $csvFilename]],
            [['data' => $csvData, 'format' => BankAccount::STATEMENT_CSV]],
            [['data' => $ofxData, 'format' => BankAccount::STATEMENT_OFX]],
            [['data' => $qifData, 'format' => BankAccount::STATEMENT_QIF]],
        ];
    }
}