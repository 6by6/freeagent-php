<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\Category;

/**
 * Class JournalEntry
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/journal_sets
 */
class JournalEntry extends AbstractEntity
{
    const API_ENTITY_NAME = 'journal_entry';
    const API_RESOURCE_NAME = 'journal_entries';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string");
     */
    protected $url;

    /**
     * @var string
     * @Accessor(getter="getCategoryUrl", setter="setCategoryUrl")
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $category;

    /**
     * @var Category
     */
    protected $categoryEntity;

    /**
     * @var string
     * @Groups({"post", "update", "get"})
     * @Type("string");
     */
    protected $description;

    /**
     * @var float
     * @Groups({"post", "update", "get"})
     * @Type("double");
     */
    protected $debitValue;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return JournalEntry
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return float
     */
    public function getDebitValue()
    {
        return $this->debitValue;
    }

    /**
     * @param float $debitValue
     * @return JournalEntry
     */
    public function setDebitValue($debitValue)
    {
        $this->debitValue = $debitValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryUrl()
    {
        return $this->category;
    }

    /**
     * @param string $category
     * @return Expense
     */
    public function setCategoryUrl($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        if (!$this->categoryEntity) {
            $this->categoryEntity = $this->getApi()->getOneResourceByUrl($this->getCategoryUrl());
        }

        return $this->categoryEntity;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category)
    {
        $this->categoryEntity = $category;
        $this->category = $category->getUrl();
        return $this;
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