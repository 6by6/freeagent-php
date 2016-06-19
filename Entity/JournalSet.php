<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class JournalSet
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/journal_sets
 */
class JournalSet extends AbstractEntity
{
    const API_ENTITY_NAME = 'journal_set';
    const API_RESOURCE_NAME = 'journal_sets';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

    /**
     * @var \DateTime
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $description;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $tag;

    /**
     * @Groups({"get", "post", "update"})
     * @Type("array<SixBySix\Freeagent\Entity\JournalEntry>")
     */
    protected $journalEntries;

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
     * @return \DateTime
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @param \DateTime $datedOn
     * @return JournalSet
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return JournalSet
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     * @return JournalSet
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getJournalEntries()
    {
        return $this->journalEntries;
    }

    /**
     * @param mixed $journalEntries
     */
    public function setJournalEntries(array $journalEntries)
    {
        $this->journalEntries = $journalEntries;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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