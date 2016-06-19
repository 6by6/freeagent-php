<?php

namespace SixBySix\Freeagent\Tests\OAuth2;


use SixBySix\Freeagent\OAuth2\Provider as OAuthProvider;
use SixBySix\Freeagent\Tests\TestCase;

/**
 * Class ApiTest
 * @package SixBySix\Freeagent\Tests
 */
class ApiTest extends TestCase
{

    /**
     * @test
     */
    public function connect()
    {
        $this->api->connect();

        $this->assertInstanceOf('\SixBySix\Freeagent\OAuth2\Provider', $this->api->getProvider());
        $this->assertInstanceOf('\League\OAuth2\Client\Token\AccessToken', $this->api->getAccessToken());
    }

    /**
     * @test
     * @expectedException \Exception
     * @expectedExceptionMessage invalid_grant
     */
    public function failConnect()
    {
        $this->api->setClientId('COMPLETELY_FAKE_ID');
        $this->api->connect();
    }
}