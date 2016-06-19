<?php

namespace SixBySix\Freeagent\Tests;

use SixBySix\Freeagent\Entity\Invoice;
use SixBySix\Freeagent\Exception;
use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\OAuth2\Api as Oauth2Api;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /** @var  Oauth2Api */
    protected $api;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::flushSandboxEntities();
    }

    protected function setUp()
    {
        parent::setUp();

        $this->api = new Oauth2Api(
            $clientId = getenv('API_CLIENT_ID'),
            $clientSecret = getenv('API_CLIENT_SECRET'),
            $refreshToken = getenv('API_REFRESH_TOKEN'),
            $sandbox = true
        );
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
        //self::flushSandboxEntities();
    }

    /**
     * @return Oauth2Api
     */
    public function getApi()
    {
        return $this->api;
    }

    protected static function flushSandboxEntities()
    {
        $api = new Oauth2Api(
            $clientId = getenv('API_CLIENT_ID'),
            $clientSecret = getenv('API_CLIENT_SECRET'),
            $refreshToken = getenv('API_REFRESH_TOKEN'),
            $sandbox = true
        );

        if (!$api->isSandbox()) {
            throw new Exception('Attempting to use this test suite on a live account will delete everything');
        }

        $api->connect();

        /** @var string[] $entities */
        $entities = ['invoice', 'project', 'contact', 'bankAccount'];

        /** @var string $entityName */
        foreach ($entities as $entityName) {
            /** @var AbstractEntity $entity */
            foreach ($api->$entityName()->query() as $entity) {
                if ($entity instanceof Invoice && !$entity->isDraft()) {
                    $entity->markAsDraft();
                }
                $entity->delete();
            }
        }
    }
}