<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Entity\Task;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Tests\TestCase;

class TaskTest extends AbstractEntityTest
{
    private static $currentUrl;

    private static $projectUrl;

    private static $contactUrl;

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Task';
    }

    public function getApiMethodName()
    {
        return 'task';
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
        $project->setName("Retainer");
        $project->setCurrency('GBP');
        $project->setStatus('Active');
        $project->setBudgetUnits('Hours');
        $project->setContactUrl($contact->getUrl());

        $project->save();

        self::$projectUrl = $project->getUrl();

        /** @var Task $task */
        $task = $this->api->task();
        $task->setProjectUrl(self::$projectUrl);

        foreach ($json as $methodName => $value) {
            $task->{$methodName}($value);
        }

        $task->save();

        self::$currentUrl = $task->getUrl();
    }

    /**
     * @test
     * @depends createOne
     */
    public function getOne()
    {
        /** @var Task $project */
        $task = $this->api->task()->getByUrl(self::$currentUrl);
        $this->assertEquals($task->getUrl(), self::$currentUrl);


        $this->assertInstanceOf('SixBySix\Freeagent\Entity\Project', $task->getProject());
        $this->assertEquals($task->getProject()->getUrl(), self::$projectUrl);
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
     * @depends getOne
     */
    public function deleteOne()
    {
        /** @var Task $task */
        $task = $this->api->task()->getByUrl(self::$currentUrl);
        $task->delete();

        /** @var Project $project */
        $project = $this->api->project()->getByUrl(self::$projectUrl);
        $project->delete();

        /** @var Contact $contact */
        $contact = $this->api->contact()->getByUrl(self::$contactUrl);
        $contact->delete();
    }

    public function createOneProvider()
    {
        return [
            [
                [
                    "setName" => "Sample Task",
                    "setIsBillable" => true,
                    "setBillingRate" => "80.0",
                    "setBillingPeriod" => "hour",
                    "setStatus" => "Active",
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
                    "name" => "Sample Task",
                    "is_billable" => true,
                    "billing_rate" => "0.0",
                    "billing_period" => "hour",
                    "status" => "Active",
                    "created_at" => "2011-08-16T11:06:57.500Z",
                    "updated_at" => "2011-08-16T11:06:57.500Z",
                ],
                [
                    "getName" => "Sample Task",
                    "getIsBillable" => true,
                    "getBillingRate" => "0.0",
                    "getBillingPeriod" => "hour",
                    "getStatus" => "Active",
                    "getCreatedAt" => new \DateTime("2011-08-16T11:06:57.500Z"),
                    "getUpdatedAt" => new \DateTime("2011-08-16T11:06:57.500Z"),
                ]
            ]
        ];
    }
}