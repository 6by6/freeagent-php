<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\PostDeserialize;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerBuilder;
use SixBySix\Freeagent\OAuth2\Api;

abstract class AbstractEntity
{
    /**
     * @Exclude
     * @var Api
     */
    static protected $api;

    static protected $serializer;

    /**
     * @Accessor(getter="getId")
     * @Groups({"update", "post", "get"})
     * @Type("integer")
     */
    protected $id;

    /**
     * @PostDeserialize
     */
    public function afterDeserialize()
    {
        if (!$this->id && ($this->getUrl() !== null)) {
            $this->setId($this->getIdFromUrl($this->getUrl()));
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Api
     */
    public function getApi()
    {
        return self::$api;
    }

    /**
     * @param Api $api
     */
    public function setApi($api)
    {
        self::$api = $api;
    }

    /**
     * @return mixed
     */
    public static function getSerializer()
    {
        if (!self::$serializer) {
            self::$serializer = SerializerBuilder::create()->build();
        }

        return self::$serializer;
    }

    public static function deserialize($data)
    {
        return self::getSerializer()->fromArray(
            $data,
            get_called_class(),
            DeserializationContext::create()->setGroups(['get'])
        );
    }

    /**
     * @param array $filters
     * @return EntityCollection
     */
    public function query(array $filters = [])
    {
        /** @var string $url */
        $url = $this->getApi()->getUrl($this->getApiResourceName(), $this->getDefaultQueryParams());

        /** @var EntityCollection $collection */
        $collection = new EntityCollection($this->getApi(), $this);
        $collection->setFilters($filters);

        return $collection;
    }

    public function save()
    {
        if ($this->getUrl()) {

            /** @var mixed[] $data */
            $data = $this->getApi()->getSerializer()->toArray(
                $this,
                SerializationContext::create()->setGroups(['post'])
            );

            /** @var mixed[] $response */
            $this->getApi()->PUT($this->getUrl(), json_encode([$this->getApiEntityName() => $data]));

        } else {

            /** @var mixed[] $data */
            $data = $this->getApi()->getSerializer()->toArray(
                $this,
                SerializationContext::create()->setGroups(['update'])
            );

            /** @var mixed[] $response */
            $response = $this->getApi()->POST($this->getPostUrl(), json_encode([$this->getApiEntityName() => $data]));

            $object = self::deserialize($response[$this->getApiEntityName()]);

            $this->url = $object->getUrl();
            $this->setId($this->getIdFromUrl($this->url));
        }

        return $this;
    }

    public function delete()
    {
        if ($this->canDelete()) {
            $url = $this->getUrl();
            $this->getApi()->DELETE($url);
        }
    }

    public function canDelete()
    {
        return true;
    }

    public function getById($id)
    {
        /** @var string $url */
        $url = $this->getApi()->getUrl(
            $this->getApiResourceName() . "/" . (int) $id
        );

        return $this->getByUrl($url);
    }

    public function getByUrl($url)
    {
        /** @var mixed[] $response */
        $response = $this->getApi()->GET($url);

        /** @var mixed[] $entityData */
        $entityData = current($response);

        /** @var AbstractEntity $entity */
        $entity = self::deserialize($entityData);

        return $entity;
    }

    public function getPostUrl()
    {
        return $this->getApi()->getUrl($this->getApiResourceName());
    }

    public function formatFilters(array $filters = [])
    {
        return $filters;
    }

    public function parseCollectionResponse(array $response)
    {
        return $response;
    }

    public function getDefaultQueryParams()
    {
        return [];
    }

    public function getApiEntityCollectionName()
    {
        return sprintf("%ss", $this->getApiEntityName());
    }

    protected function getIdFromUrl($url)
    {
        /** @var integer $id */
        $id = (int) substr($url, strrpos($url, '/') + 1);

        if (is_int($id) && $id != 0) {
            return $id;
        }
    }

    abstract public function getUrl();

    abstract public function getApiResourceName();

    abstract public function getApiEntityName();
}