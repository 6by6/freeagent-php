<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\Timeslip;
use SixBySix\Freeagent\Entity\User;
use SixBySix\Freeagent\Tests\TestCase;

class TimeslipTest extends AbstractEntityTest
{
    public function setUp()
    {
        parent::setUp();
        $this->api->connect();
    }

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\Timeslip';
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    'task' => '',
                    'billedOnInvoice' => '',
                    'datedOn' => '',
                    'hours' => '1.3',
                    'comment' => 'This is a test timeslip',
                    'updatedAt' => '2011-08-16T13:32:00Z',
                    'createdAt' => '2011-08-16T13:32:00Z',
                ],
                [

                ]
            ]
        ];
    }


    public function getOne()
    {
        // @todo not complete
    }

    public function getApiMethodName()
    {
        return 'timeslips';
    }
}