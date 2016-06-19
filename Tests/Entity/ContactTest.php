<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Tests\TestCase;

class ContactTest extends AbstractEntityTest
{
    private static $currentUrl;

    public function setUp()
    {
        parent::setUp();
        $this->api->connect();
    }

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Contact';
    }

    public function getApiMethodName()
    {
        return 'contact';
    }

    /**
     * @test
     * @todo test all filters
     */
    public function getFiltered()
    {
        /** @var Contact[] $contacts */
        $contacts = $this->api->contact()->query([
            'view' => Contact::VIEW_COMPLETED_PROJECTS
        ]);

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $contacts);

        /** @var Contact $c */
        foreach ($contacts as $c) {
            $this->assertInstanceOf('SixBySix\Freeagent\Entity\Contact', $c);
        }
    }

    /**
     * @test
     * @dataProvider createOneProvider
     * @param $json
     */
    public function createOne($json)
    {
        /** @var Contact $contact */
        $contact = $this->api->contact();

        foreach ($json as $methodName => $value) {
            $contact->{$methodName}($value);
        }

        $contact->save();

        $this->assertNotNull($contact->getUrl());

        self::$currentUrl = $contact->getUrl();
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$currentUrl);
        $this->assertEquals($contact->getUrl(), self::$currentUrl);
    }

    /**
     * @test
     * @dataProvider updateOneProvider
     * @depends getOne
     * @param $data
     */
    public function updateOne(array $data)
    {
        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$currentUrl);

        foreach ($data as $method => $value) {
            $contact->{"set{$method}"}($value);
        }

        $contact->save();

        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$currentUrl);

        foreach ($data as $method => $value) {
            $this->assertEquals($value, $contact->{"get{$method}"}());
        }
    }

    /**
     * @test
     */
    public function getInvoices()
    {
        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$currentUrl);

        // try empty collection first

        /** @var EntityCollection $invoices */
        $invoices = $contact->getInvoices();
        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $invoices);
        $this->assertEquals(0, $invoices->count());

        // create an invoice and retrieve it
        /** @var \SixBySix\Freeagent\Entity\Invoice $invoice */
        $invoice = $this->api->invoice()
            ->setDatedOn(new \DateTime('now'))
            ->setPaymentTermsInDays(30)
            ->setContact($contact)
            ->save();

        // create another contact + invoice for noise
        /** @var Contact $contact2 */
        $contact2 = $this->api->contact()
            ->setOrganisationName('Big Fish Company')
            ->save();

        $this->api->invoice()
            ->setContact($contact2)
            ->setDatedOn(new \DateTime('now'))
            ->setPaymentTermsInDays(30)
            ->save();

        $invoices = $contact->getInvoices();
        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $invoices);
        $this->assertEquals(1, $invoices->count());
        $this->assertEquals($invoice->getId(), $invoices->get(0)->getId());
    }

    /**
     * @test
     * @depends getOne
     * @expectedException \SixBySix\Freeagent\Exception
     * @expectedExceptionMessage Resource not found
     */
    public function deleteOne()
    {
        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$currentUrl);

        /** @var \SixBySix\Freeagent\Entity\Invoice $invoice */
        foreach ($contact->getInvoices() as $invoice) {
            $invoice->delete();
        }

        $contact->delete();

        $this->api->contact()->getByUrl(self::$currentUrl);
    }

    public function createOneProvider()
    {
        return [
            [
                [
                    'setOrganisationName' => "ACME",
                    'setFirstName' => "John",
                    'setLastName' => "Smith",
                    'setEmail' => "acme@example.com",
                    'setBillingEmail' => "billing@example.com",
                    'setPhoneNumber' => "12345678",
                    'setMobile' => "9876543210",
                    'setAddress1' => "11 George Street",
                    "setAddress2" => "Kings Court",
                    "setAddress3" => "Flat 6",
                    "setTown" => "London",
                    "setRegion" => "Southwark",
                    "setPostcode" => "SE1 6HA",
                    "setCountry" => "United Kingdom",
                    "setContactNameOnInvoices" => true,
                    "setLocale" => "en",
                    "setUsesContactInvoiceSequence" => false,
                    "setChargeSalesTax" => Contact::CHARGE_SALES_TAX_NEVER,
                    "setSalesTaxRegistrationNumber" => "ST12345",
                ]
            ]
        ];
    }

    public function updateOneProvider()
    {
        return [
            [
                [
                    'FirstName' => 'Joe',
                    'LastName' => 'Bloggs',
                    'OrganisationName' => 'Joe Bloggs Limited',
                    'Email' => 'joe.bloggs@example.com',
                    'BillingEmail' => 'joe+billing@example.com',
                    'PhoneNumber' => '0141 123123',
                    'Mobile' => '07772009871',
                    'Address1' => '23D',
                    'Address2' => 'Errol Gardens',
                    'Address3' => '',
                    'Town' => 'Glasgow',
                    'Region' => 'Glasgow',
                    'Postcode' => 'G5 ORA',
                    'Country' => 'France',
                    'ContactNameOnInvoices' => true,
                    'Locale' => 'en',
                    'UsesContactInvoiceSequence' => true,
                    'ChargeSalesTax' => 'Always',
                    'SalesTaxRegistrationNumber' => '987654321',
                    'Status' => 'Active',
                ]
            ]
        ];
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    'url' => 'http://www.example.com',
                    'first_name' => 'John',
                    'last_name' => 'Smith',
                    'organisation_name' => 'John Smith Ltd.',
                    'email' => 'john.smith@example.com',
                    'billing_email' => 'john.smith+billing@example.com',
                    'phone_number' => '01506 670423',
                    'mobile' => '077720967890',
                    'address1' => '3/4',
                    'address2' => '33 Oswald Street',
                    'address3' => '',
                    'town' => 'Glasgow',
                    'region' => 'Glasgow',
                    'postcode' => 'G1 4PG',
                    'country' => 'United Kingdom',
                    'contact_name_on_invoices' => true,
                    'locale' => 'en',
                    'account_balance' => -1200.50,
                    'uses_contact_invoice_sequence' => false,
                    'charge_sales_tax' => 'Auto',
                    'sales_tax_registration_number' => '12345678',
                    'active_projects_count' => 3,
                    'status' => 'Active',
                    'created_at' => '2014-05-06T12:27:18.000Z',
                    'updated_at' => '2016-03-07T08:27:41.000Z',
                ],
                [
                    'getUrl' => 'http://www.example.com',
                    'getFirstName' => 'John',
                    'getLastName' => 'Smith',
                    'getOrganisationName' => 'John Smith Ltd.',
                    'getEmail' => 'john.smith@example.com',
                    'getBillingEmail' => 'john.smith+billing@example.com',
                    'getPhoneNumber' => '01506 670423',
                    'getMobile' => '077720967890',
                    'getAddress1' => '3/4',
                    'getAddress2' => '33 Oswald Street',
                    'getAddress3' => '',
                    'getTown' => 'Glasgow',
                    'getRegion' => 'Glasgow',
                    'getPostcode' => 'G1 4PG',
                    'getCountry' => 'United Kingdom',
                    'getContactNameOnInvoices' => true,
                    'getLocale' => 'en',
                    'getAccountBalance' => -1200.50,
                    'getUsesContactInvoiceSequence' => false,
                    'getChargeSalesTax' => 'Auto',
                    'getSalesTaxRegistrationNumber' => '12345678',
                    'getActiveProjectsCount' => 3,
                    'getStatus' => 'Active',
                ]
            ]
        ];
    }
}