<?php

namespace SixBySix\Freeagent\Tests\Entity\Company;

use SixBySix\Freeagent\Entity\Company;
use SixBySix\Freeagent\Entity\TaxEvent;
use SixBySix\Freeagent\Tests\TestCase;

class TaxEventTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->api->connect();
    }

    /**
     * @test
     */
    public function getUpcomingTaxEventsFromCompany()
    {
        /** @var Company $company */
        $company = $this->api->getCompany();

        /** @var array $taxEvents */
        $taxEvents = $company->getUpcomingTaxEvents();

        $this->assertInternalType('array', $taxEvents);
    }

    /**
     * @test
     * @dataProvider deserializeProvider
     * @param $json
     * @param $accessors
     */
    public function deserialize($json, $accessors)
    {
        /** @var TaxEvent $taxEvent */
        $taxEvent = new TaxEvent();
        $taxEvent->setApi($this->api);
        $taxEvent = $taxEvent->deserialize($json);

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\TaxEvent', $taxEvent);

        foreach ($accessors as $methodName => $value) {
            $this->assertEquals($value, $taxEvent->$methodName());
        }

        $this->assertEquals($taxEvent->getDatedOn()->format('Y-m-d'), $json['dated_on']);
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    'description' => 'Example tax event description',
                    'nature' => 'Payment Due',
                    'dated_on' => '2015-02-18',
                    'amount_due' => 10.00,
                    'is_personal' => true,
                ],
                [
                    'getDescription' => 'Example tax event description',
                    'getNature' => 'Payment Due',
                    'getAmountDue' => 10.00,
                    'getIsPersonal' => true,
                ]
            ]
        ];
    }
}