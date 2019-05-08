<?php

namespace SixBySix\Freeagent\Tests\Entity;

use Doctrine\Tests\Common\Annotations\Ticket\Doctrine\ORM\Mapping\Entity;
use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Entity\Invoice;
use SixBySix\Freeagent\Entity\InvoiceItem;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Tests\TestCase;

class InvoiceTest extends AbstractEntityTest
{
    protected static $currentUrl;
    protected static $contactUrl;
    protected static $projectUrl;

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Invoice';
    }

    /**
     * @test
     * @dataProvider createOneProvider
     * @param $json
     */
    public function createOne($json)
    {
        // create a contact to associate with
        $contact = $this->api->contact();
        $contact->setOrganisationName('Totally Cool Ltd.');
        $contact->save();

        self::$contactUrl = $contact->getUrl();

        /** @var Project $project */
        $project = $this->api->project();
        $project->setName('Retainer');
        $project->setContactUrl(self::$contactUrl);
        $project->setStatus('Active');
        $project->setCurrency('GBP');
        $project->setBudgetUnits('Hours');
        $project->save();

        self::$projectUrl = $project->getUrl();

        /** @var Invoice $invoice */
        $invoice = $this->api->invoice();

        foreach ($json as $methodName => $value) {
            $invoice->{$methodName}($value);
        }

        //$invoice->setProjectUrl(self::$projectUrl);
        $invoice->setContactUrl(self::$contactUrl);
        $invoice->save();

        self::$currentUrl = $invoice->getUrl();
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        /** @var Invoice $invoice */
        $invoice = $this->getCurrentInvoice();
        $this->assertEquals($invoice->getUrl(), self::$currentUrl);
    }

    /**
     * @_test
     * @dataProvider updateOneProvider
     * @depends getOne
     * @param $data
     */
    public function updateOne(array $data)
    {
        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$currentUrl);

        foreach ($data as $method => $value) {
            $project->{"set{$method}"}($value);
        }

        $project->save();

        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$currentUrl);

        foreach ($data as $method => $value) {
            $this->assertEquals($value, $project->{"get{$method}"}());
        }
    }

    /**
     * @test
     */
    public function getFiltered()
    {
        /** @var EntityCollection $collection */
        $collection = $this->api->invoice()->query();

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $collection);

    }

    /**
     * @test
     * @depends getOne
     */
    public function transitionFlow()
    {
        // this number should stay consistent
        /** @var integer $origInvoiceCount */
        $origInvoiceCount = $this->api->invoice()->query()->count();

        /** @var Invoice $invoice */
        $invoice = $this->getCurrentInvoice();
        $invoice->setDatedOn(new \DateTime('+7 days'));
        $invoice->setSendNewInvoiceEmails(true);
        $invoice->save();

        // schedule
        $invoice->markAsScheduled();
        $invoice = $this->getCurrentInvoice();
        $this->assertEquals($origInvoiceCount, $this->api->invoice()->query()->count());
        $this->assertTrue($invoice->isScheduled());
        $this->assertEquals(Invoice::STATUS_SCHEDULED, $invoice->getStatus());

        // mark as sent
        $invoice->markAsSent();
        $invoice = $this->getCurrentInvoice();
        $this->assertEquals($origInvoiceCount, $this->api->invoice()->query()->count());
        $this->assertTrue($invoice->isOpen());
        $this->assertEquals(Invoice::STATUS_OPEN, $invoice->getStatus());

        $invoice->markAsDraft();
        // @todo can't figure out the Cancelled state
    }

    /**
     * @test
     */
    public function invoiceItems()
    {
        // saving invoice twice doesn't create duplicate entries

        /** @var Invoice $invoice */
        $invoice = $this->getCurrentInvoice();

        /** @var integer $itemCount */
        $itemCount = sizeof($invoice->getInvoiceItems());

        $invoice->save();

        $invoice = $this->getCurrentInvoice();
        $this->assertEquals($itemCount, sizeof($invoice->getInvoiceItems()));
    }

    /**
     * @test
     * @depends transitionFlow
     * @expectedException \SixBySix\Freeagent\Exception
     * @expectedExceptionMessage Resource not found
     */
    public function deleteOne()
    {
        /** @var Invoice $invoice */
        $invoice = $this->getCurrentInvoice();
        $invoice->delete();

        // should invoke the expected Exception
        $this->getCurrentInvoice();
    }

    public function createOneProvider()
    {
        /** @var InvoiceItem $invoiceItem1 */
        $invoiceItem1 = new InvoiceItem();
        $invoiceItem1->setDescription('1 Month of Support');
        $invoiceItem1->setItemType(InvoiceItem::ITEM_TYPE_SERVICES);
        $invoiceItem1->setPrice(500.00);
        $invoiceItem1->setQuantity(1);

        /** @var InvoiceItem $invoiceItem2 */
        $invoiceItem2 = new InvoiceItem();
        $invoiceItem2->setDescription('SuperSoftware License (per host)');
        $invoiceItem2->setItemType(InvoiceItem::ITEM_TYPE_PRODUCTS);
        $invoiceItem2->setPrice(150.00);
        $invoiceItem2->setQuantity(3);

        return [
            [
                [
                    "setSendNewInvoiceEmails" => false,
                    "setPaymentTermsInDays" => 30,
                    "setDatedOn" => new \DateTime('+1 week'),
                    "setDueOn" => new \DateTime('+1 month'),
                    "setInvoiceItems" => [
                        $invoiceItem1,
                        $invoiceItem2,
                    ]
                ]
            ]
        ];
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    "url" => "https://api.sandbox.freeagent.com/v2/invoices/100",
                    "contact" => "https://api.sandbox.freeagent.com/v2/contacts/2",
                    "dated_on" => "2001-12-12",
                    "due_on" => "2001-12-17",
                    "reference" => "003",
                    "currency" => "GBP",
                    "exchange_rate" => "1.0",
                    "net_value" => "0.0",
                    "total_value" =>  "200.0",
                    "paid_value" =>  "0.0",
                    "due_value" =>  "200.0",
                    "status" => "Draft",
                    "omit_header" => false,
                    "always_show_bic_and_iban" =>  false,
                    "send_thank_you_emails" => false,
                    "send_reminder_emails" => false,
                    "send_new_invoice_emails" =>  false,
                    "bank_account" =>  "https://api.sandbox.freeagent.com/v2/bank_accounts/1",
                    "payment_terms_in_days" => 5,
                ],
                [
                    "getId" => 100,
                    "getUrl" => "https://api.sandbox.freeagent.com/v2/invoices/100",
                    "getContactUrl" => "https://api.sandbox.freeagent.com/v2/contacts/2",
                    // @todo issue with formats
                    //"getDatedOn" => new \DateTime("2001-12-12"),
                    //"getDueOn" => new \DateTime("2001-12-17"),
                    "getReference" => "003",
                    "getCurrency" => "GBP",
                    "getExchangeRate" => "1.0",
                    "getNetValue" => "0.0",
                    "getTotalValue" =>  "200.0",
                    "getPaidValue" =>  "0.0",
                    "getDueValue" =>  "200.0",
                    "getStatus" => "Draft",
                    "getOmitHeader" => false,
                    "getAlwaysShowBicAndIban" =>  false,
                    "getSendThankYouEmails" => false,
                    "getSendReminderEmails" => false,
                    "getSendNewInvoiceEmails" =>  false,
                    "getBankAccountUrl" =>  "https://api.sandbox.freeagent.com/v2/bank_accounts/1",
                    "getPaymentTermsInDays" => 5,
                ]
            ]
        ];
    }

    public function getApiMethodName()
    {
        return 'invoice';
    }

    /**
     * @return \SixBySix\Freeagent\Entity\Invoice
     */
    protected function getCurrentInvoice()
    {
        return $this->api->invoice()->getByUrl(self::$currentUrl);
    }
}
