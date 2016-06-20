<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\Tests\TestCase;

abstract class AbstractEntityTest extends TestCase
{
    /** @var  AbstractEntity */
    protected $entity;

    public function setUp()
    {
        parent::setUp();
        $this->api->connect();

        $this->entity = $this->api->{$this->getApiMethodName()}();
    }

    /**
     * @test
     */
    public function getAll()
    {
        /** @var AbstractEntity[] $entities */
        $entities = $this->entity->query();

        $this->assertInstanceOf('SixBySix\Freeagent\Entity\EntityCollection', $entities);
    }

    /**
     * @test
     * @dataProvider deserializeProvider
     * @param $json
     * @param $accessors
     */
    public function deserialize($json, $accessors)
    {
        /** @var AbstractEntity $entity */
        $entity = $this->api->{$this->getApiMethodName()}()->deserialize($json);

        $this->assertInstanceOf($this->getClassName(), $entity);

        foreach ($accessors as $methodName => $value) {
            if ($value instanceof \DateTime) {
                $this->assertLessThan(
                    60, // give a buffer for number of seconds dates can differ (Y-m-d dates can't be compared otherwise)
                    $value->diff($entity->$methodName())->s,
                    "{$methodName}()"
                );
            } else {
                $this->assertEquals(
                    $value,
                    $entity->$methodName(),
                    "{$methodName}()"
                );
            }
        }
    }

    /**
     * @test
     */
    public function getOne()
    {
        /** @var AbstractEntity $first */
        $first = $this->entity->query()->getFirst();

        if (!$first) {
            $this->fail(
                sprintf('No instances of %s found, cannot test', get_class($this->entity))
            );
        }

        /** @var AbstractEntity $entity */
        $entity = $this->entity->getByUrl($first->getUrl());

        $this->assertInstanceOf($this->getClassName(), $entity);
    }

    /**
     * @return string
     */
    abstract public function getApiMethodName();

    /**
     * @return string
     */
    abstract public function getClassName();

    /**
     * @return array
     */
    abstract public function deserializeProvider();
}
