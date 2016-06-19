<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Contact;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Entity\Invoice;
use SixBySix\Freeagent\Entity\InvoiceItem;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Tests\TestCase;

class InvoiceTimelineTest extends AbstractEntityTest
{
    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\InvoiceTimelineItem';
    }

    /**
     * @ignore
     */
    public function getOne()
    {
    }

    /**
     * @test
     */
    public function getAll()
    {
        /** @var EntityCollection $entities */
        $entities = $this->entity->query();
        $this->assertEquals(0, $entities->count());
        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $entities);

        /** @var Contact $contact */
        $contact = $this->api->contact()
            ->setOrganisationName('Big Fish Company')
            ->save();

        /** @var Project $project */
        $project = $this->api->project()
            ->setName('Retainer')
            ->setCurrency('GBP')
            ->setBudgetUnits(Project::UNITS_HOURS)
            ->setStatus(Project::STATUS_ACTIVE)
            ->setContact($contact)
            ->save();

        /** @var Invoice $invoice */
        $invoice = $this->api->invoice()
            ->setDatedOn(new \DateTime('-1 day'))
            ->setDueOn(new \DateTime('-1 day'))
            ->setContact($contact)
            ->setProject($project)
            ->addInvoiceItem([
                'item_type' => InvoiceItem::ITEM_TYPE_DAYS,
                'amount' => 1,
                'description' => 'General Support',
                'price' => 70,
                'quantity' => 1,
            ])
            ->save();

        $invoice->markAsSent();

        $entities = $this->entity->query();

        // @todo finish alongside bank transaction explanations
        foreach ($entities as $timelineItem) {
        }
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    "reference" => "007",
                    "summary" => 'Payment: 007: \u00a314.40 received',
                    "description" => "resras",
                    "dated_on" => "2011-09-02",
                    "amount" => "14.4"
                ],
                [
                    "getReference" => "007",
                    "getSummary" => 'Payment: 007: \u00a314.40 received',
                    "getDescription" => "resras",
                    // @todo time screws up this match "getDatedOn" => new \DateTime("2011-09-02"),
                    "getAmount" => 14.4,
                ]
            ]
        ];
    }

    public function getApiMethodName()
    {
        return 'invoiceTimeline';
    }
}