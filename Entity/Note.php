<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\AbstractEntity;

/**
 * Class Note
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/notes
 */
class Note extends AbstractEntity
{
    const API_ENTITY_NAME = 'note';
    const API_RESOURCE_NAME = 'notes';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $note;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $parentUrl;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $author;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $updatedAt;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $createdAt;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param string $note
     * @return Note
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $author
     * @return Note
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return string
     */
    public function getParentUrl()
    {
        return $this->parentUrl;
    }

    /**
     * @param string $parentUrl
     * @return Note
     */
    public function setParentUrl($parentUrl)
    {
        $this->parentUrl = $parentUrl;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }
}