<?php

namespace SixBySix\Freeagent\Tests\Entity;

use DateTime;
use SixBySix\Freeagent\Entity\Company;
use SixBySix\Freeagent\Entity\InvoiceItem;
use SixBySix\Freeagent\Tests\TestCase;

class BankTransactionExplanationTest extends AbstractEntityTest
{
    protected static $currentUrl;

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\BankTransactionExplanation';
    }

    public function getApiMethodName()
    {
        return 'bankTransactionExplanation';
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    "bank_transaction" => "https://api.freeagent.com/v2/bank_transactions/8",
                    "bank_account"     => "https://api.freeagent.com/v2/bank_accounts/1",
                    "dated_on"         => "2010-05-01",
                    "description"      => "harness end-to-end e-business",
                    "ec_status"        => "EC Goods",
                    "gross_value"      => "-730.0",
                    "place_of_supply"  => "Greece",
                    "project"          => "https://api.freeagent.com/v2/projects/1",
                    "rebill_type"      => "markup",
                    "rebill_factor"    => "0.25",
                    "type"             => "Payment",
                ],
                [
                    "getBankTransactionUrl" => "https://api.freeagent.com/v2/bank_transactions/8",
                    "getBankAccountUrl"     => "https://api.freeagent.com/v2/bank_accounts/1",
                    "getDatedOn"            => new DateTime("2010-05-01"),
                    "getDescription"        => "harness end-to-end e-business",
                    "getEcStatus"           => "EC Goods",
                    "getGrossValue"         => "-730.0",
                    "getPlaceOfSupply"      => "Greece",
                    "getProjectUrl"         => "https://api.freeagent.com/v2/projects/1",
                    "getRebillType"         => "markup",
                    "getRebillFactor"       => "0.25",
                    "getType"               => "Payment",
                ]
            ]
        ];
    }

    public function createOneProvider()
    {
        return [
            [
                [
                    'setGrossValue'  => 123.45,
                    'setDatedOn'     => new DateTime(),
                    'setDescription' => 'Test description.',
                ]
            ]
        ];
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        $explanation = $this->api->bankTransactionExplanation()
            ->getByUrl(self::$currentUrl);

        $this->assertEquals($explanation->getUrl(), self::$currentUrl);
    }

    /**
     * @test
     * @dataProvider createOneProvider
     * @param $json
     */
    public function createOne($json)
    {
        $bankAccount = $this->api->bankAccount()
            ->query()
            ->getFirst();

        $contact = $this->api->contact()
            ->setOrganisationName('Totally Cool Ltd.')
            ->save();

        $invoiceItem = (new InvoiceItem())
                    ->setDescription('Services')
                    ->setItemType(InvoiceItem::ITEM_TYPE_SERVICES)
                    ->setPrice(123.45)
                    ->setQuantity(1);

        $invoice = $this->api->invoice()
            ->setInvoiceItems([$invoiceItem])
            ->setDatedOn(new \DateTime('now'))
            ->setPaymentTermsInDays(30)
            ->setContact($contact)
            ->save();

        /** @var BankTransactionExplanation $explanation */
        $explanation = $this->api->bankTransactionExplanation()
                            ->setBankAccountUrl($bankAccount->getUrl())
                            ->setPaidInvoiceUrl($invoice->getUrl());

        foreach ($json as $methodName => $value) {
            $explanation->{$methodName}($value);
        }

        $explanation->save();

        self::$currentUrl = $explanation->getUrl();

        $this->assertNotEmpty($explanation->getUrl());
    }
}
