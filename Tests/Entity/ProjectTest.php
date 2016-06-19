<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Tests\TestCase;

class ProjectTest extends AbstractEntityTest
{
    private static $currentUrl;

    private static $contactUrl;

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Project';
    }

    public function getApiMethodName()
    {
        return 'project';
    }

    /**
     * @test
     * @dataProvider createOneProvider
     * @param $json
     */
    public function createOne($json)
    {
        // create a contact to associate with
        $contact = new Contact();
        $contact->setOrganisationName('Totally Cool Ltd.');
        $contact->save();

        self::$contactUrl = $contact->getUrl();

        /** @var Project $project */
        $project = $this->api->project();
        $project->setContactUrl(self::$contactUrl);

        foreach ($json as $methodName => $value) {
            $project->{$methodName}($value);
        }

        $project->save();

        $this->assertNotNull($project->getUrl());

        self::$currentUrl = $project->getUrl();
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$currentUrl);
        $this->assertEquals($project->getUrl(), self::$currentUrl);
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
    public function getInvoices()
    {
        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$currentUrl);

        // try empty collection first

        /** @var EntityCollection $invoices */
        $invoices = $project->getInvoices();
        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $invoices);
        $this->assertEquals(0, $invoices->count());

        // create an invoice and retrieve it
        /** @var \SixBySix\Freeagent\Entity\Invoice $invoice */
        $invoice = $this->api->invoice()
            ->setDatedOn(new \DateTime('now'))
            ->setPaymentTermsInDays(30)
            ->setContact($project->getContact())
            ->setProject($project)
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

        $invoices = $project->getInvoices();
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
        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$currentUrl);

        /** @var \SixBySix\Freeagent\Entity\Invoice $invoice */
        foreach ($project->getInvoices() as $invoice) {
            $invoice->delete();
        }

        $project->delete();

        $this->expectExceptionMessage('Resource not found');
        $this->api->project()->getByUrl(self::$currentUrl);

        $contact = $this->api->contact()->getByUrl(self::$contactUrl);
        $contact->delete();
    }



    public function createOneProvider()
    {
        return [
            [
                [
                    "setName" => "New Site Build",
                    "setBudget" => 8000,
                    "setIsIr35" => false,
                    "setStatus" => "Active",
                    "setBudgetUnits" => "Hours",
                    "setNormalBillingRate" => "0.0",
                    "setHoursPerDay" => "8.0",
                    "setUsesProjectInvoiceSequence" => false,
                    "setCurrency" => "GBP",
                    "setBillingPeriod" => "hour",
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
                    "url" => "https://api.freeagent.com/v2/projects/1",
                    "name" => "Test Project",
                    "contact" => "https://api.freeagent.com/v2/contacts/1",
                    "budget" => 0,
                    "is_ir35" => false,
                    "status" => "Active",
                    "budget_units" => "Hours",
                    "normal_billing_rate" => "0.0",
                    "hours_per_day" => "8.0",
                    "uses_project_invoice_sequence" => false,
                    "currency" => "GBP",
                    "billing_period" => "hour",
                    "created_at" => "2011-09-14T16:05:57.1Z",
                    "updated_at" => "2011-09-14T16:05:57.1Z",
                ],
                [
                    "getUrl" => "https://api.freeagent.com/v2/projects/1",
                    "getName" => "Test Project",
                    "getContactUrl" => "https://api.freeagent.com/v2/contacts/1",
                    "getBudget" => 0,
                    "getIsIr35" => false,
                    "getStatus" => "Active",
                    "getBudgetUnits" => "Hours",
                    "getNormalBillingRate" => "0.0",
                    "getHoursPerDay" => "8.0",
                    "getUsesProjectInvoiceSequence" => false,
                    "getCurrency" => "GBP",
                    "getBillingPeriod" => "hour",
                    "getCreatedAt" => new \DateTime("2011-09-14T16:05:57.1Z"),
                    "getUpdatedAt" => new \DateTime("2011-09-14T16:05:57.1Z"),
                ]
            ]
        ];
    }
}