<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Entity\Invoice;
use SixBySix\Freeagent\Entity\InvoiceItem;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Entity\User;
use SixBySix\Freeagent\OAuth2\Api;
use SixBySix\Freeagent\Tests\TestCase;

class EntityCollectionTest extends TestCase
{
    public static $invoices = [];

    public static $contacts = [];

    public static $projects = [];

    public function setUp()
    {
        parent::setUp();

        self::$invoices = [];
        self::$contacts = [];
        self::$projects = [];


        $this->api->connect();

        /** @var Contact $contact1 */
        $contact1 = $this->api->contact();
        $contact1->setOrganisationName('Totally Cool Ltd.');
        $contact1->save();
        self::$contacts[] = $contact1;

        /** @var Contact $contact2 */
        $contact2 = $this->api->contact();
        $contact2->setOrganisationName('Totally Not Cool PLC.');
        $contact2->save();
        self::$contacts[] = $contact2;

        /** @var Project $project1 */
        $project1 = $this->api->project();
        $project1->setName('Retainer');
        $project1->setContact($contact1);
        $project1->setStatus('Active');
        $project1->setCurrency('GBP');
        $project1->setBudgetUnits('Hours');
        $project1->save();
        self::$projects[] = $project1;

        /** @var Project $project2 */
        $project2 = $this->api->project();
        $project2->setName('New Build');
        $project2->setContact($contact2);
        $project2->setStatus('Active');
        $project2->setCurrency('GBP');
        $project2->setBudgetUnits('Hours');
        $project2->save();
        self::$projects[] = $project2;

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

        /** @var Invoice $invoice1 */
        $invoice1 = $this->api->invoice();
        $invoice1->setContact($contact1);
        $invoice1->setProject($project1);
        $invoice1->setPaymentTermsInDays(30);
        $invoice1->setDatedOn(new \DateTime('-1 day'));
        $invoice1->setDueOn(new \DateTime('+1 month'));
        $invoice1->setInvoiceItems([$invoiceItem1, $invoiceItem2]);
        $invoice1->save();

        self::$invoices[] = $invoice1;

        //$invoice1->markAsSent();

        /** @var InvoiceItem $invoiceItem3 */
        $invoiceItem3 = new InvoiceItem();
        $invoiceItem3->setDescription('1 Month of Support');
        $invoiceItem3->setItemType(InvoiceItem::ITEM_TYPE_DAYS);
        $invoiceItem3->setQuantity(3);
        $invoiceItem3->setPrice(80);
        $invoiceItem3->setQuantity(1);

        /** @var Invoice $invoice2 */
        $invoice2 = $this->api->invoice();
        $invoice2->setContact($contact2);
        $invoice2->setProject($project2);
        $invoice2->setPaymentTermsInDays(10);
        $invoice2->setDatedOn(new \DateTime('-1 day'));
        $invoice2->setDueOn(new \DateTime('+1 month'));
        $invoice2->setInvoiceItems([$invoiceItem3]);
        $invoice2->save();
        self::$invoices[] = $invoice2;
    }

    /**
     * @test
     */
    public function emptyCollection()
    {
        $collection = $this->api->task()->query();
        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $collection);

        $this->assertEquals(0, $collection->count());
    }

    /**
     * @test
     */
    public function unfilteredCollection()
    {
        $collection = $this->api->invoice()->query();

        $this->assertEquals(sizeof(self::$invoices), $collection->count());
    }

    /**
     * @test
     */
    public function filteredCollection()
    {
        $collection = $this->api->invoice()->query([
            'view' => Invoice::VIEW_DRAFT,
        ]);
    }

    /**
     * @test
     */
    public function iterate()
    {
        /** @var EntityCollection $collection */
        $collection = $this->api->invoice()->query();

        /** @var Invoice $invoice */
        foreach ($collection as $invoice) {
            $this->assertInstanceOf('SixBySix\Freeagent\Entity\Invoice', $invoice);
        }
    }

    /**
     * @test
     */
    public function resultLimits()
    {
        $collection = $this->api->invoice()->query();
        $collection->setLimit(1);
        $this->assertEquals(1, $collection->count());
    }

    public function tearDown()
    {
        parent::tearDown();

        /** @var Invoice $invoice */
        foreach (self::$invoices as $invoice) {
            if (!$invoice->isDraft()) {
                //$invoice->markAsDraft();
            }

            $invoice->delete();
        }

        /** @var Project $project */
        foreach (self::$projects as $project) {
            $project->delete();
        }

        /** @var Contact $contact */
        foreach (self::$contacts as $contact) {
            $contact->delete();
        }
    }
}