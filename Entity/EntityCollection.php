<?php

namespace SixBySix\Freeagent\Entity;

use SixBySix\Freeagent\Exception;
use SixBySix\Freeagent\OAuth2\Api;

class EntityCollection implements \Iterator
{
    const SORT_ASC = 'ASC';
    const SORT_DESC = 'DESC';

    const MAX_PAGE_LIMIT = 100;

    /** @var array */
    protected $items;

    /** @var int */
    protected $position;

    /** @var  array */
    protected $filters;

    /** @var  integer[] */
    protected $queryParams;

    /** @var  string */
    protected $sortBy;

    /** @var  string */
    protected $sortDir;

    /** @var  integer */
    protected $limit;

    /** @var  AbstractEntity */
    protected $entity;

    /** @var  Api */
    protected $api;

    /** @var  boolean */
    protected $hasExecuted;

    public function __construct(Api $api, AbstractEntity $entity, array $entities = null)
    {
        $this->position = 0;
        $this->queryParams = [];
        $this->items = [];

        $this->api = $api;
        $this->entity = $entity;

        if ($entities) {
            $this->hasExecuted = true;
            $this->items = $entities;
        } else {
            $this->hasExecuted = false;
        }
    }

    public function execute()
    {
        $this->hasExecuted = true;
        $this->items = [];

        /** @var integer $pageNum */
        $pageNum = 1;

        /** @var integer $numberResults */
        $numberResults = 0;

        /** @var int $pageSize */
        if (!$this->getLimit() || $this->getLimit() > self::MAX_PAGE_LIMIT) {
            $pageSize = self::MAX_PAGE_LIMIT;
        } else {
            $pageSize = $this->getLimit();
        }

        /** @var string[] $params */
        $params = array_merge($this->entity->getDefaultQueryParams(), $this->filters);
        $params['page'] = $pageNum;
        $params['per_page'] = $pageSize;

        if ($this->getSortBy()) {
            $params['sort'] = (($this->getSortDir() == self::SORT_DESC) ? '-' : '') . $this->getSortBy();
        }

        /** @var string $resultsKey */
        $resultsKey = sprintf('%ss', $this->entity->getApiEntityName());

        while (true) {
            // clip last page if it exceeds requested result limit
            if ($this->getLimit() && (($this->getLimit() - $numberResults) < $pageSize)) {
                $params['per_page'] = ($this->getLimit() - $numberResults);
            }

            /** @var string $url */
            $url = $this->api->getUrl($this->entity->getApiResourceName(), $params);

            /** @var mixed[] $response */
            $response = $this->api->GET($url);

            if (!isset($response[$resultsKey])) {
                throw new Exception("{$resultsKey} could not be found in query result");
            }

            /** @var mixed[] $data */
            $data = $response[$resultsKey];

            /** @var mixed[] $entityData */
            foreach ($data as $entityData) {
                $entity = $this->entity->deserialize($entityData);
                $entity->setApi($this->api);

                $this->items[] = $entity;
            }

            $numberResults += sizeof($data);

            // end of results reached?
            if (sizeof($data) < $pageSize) {
                break;
            }

            if ($this->getLimit() && ($numberResults >= $this->getLimit())) {
                break;
            }

            ++$params['page'];
        }
    }

    public function add(AbstractEntity $entity)
    {
        $this->items[] = $entity;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        if (!$this->hasExecuted) {
            $this->execute();
        }

        return $this->items[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {

        ++$this->position;
    }

    public function count()
    {

        if (!$this->hasExecuted) {
            $this->execute();
        }

        return sizeof($this->items);
    }

    public function valid()
    {
        if (!$this->hasExecuted) {
            $this->execute();
        }

        return isset($this->items[$this->position]);
    }

    /**
     * @param $position
     * @return mixed
     * @throws Exception
     */
    public function get($position)
    {
        if (!$this->hasExecuted) {
            $this->execute();
        }

        if ($position > -1 && $this->count() >= ($position + 1)) {
            return $this->items[$position];
        }
    }

    /**
     * @return mixed
     */
    public function getFirst()
    {
        return $this->get(0);
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        /** @var int $lastPosition */
        $lastPosition = $this->count() - 1;

        if ($lastPosition > -1) {
            return $this->get($lastPosition);
        }
    }

    /**
     * @return mixed
     */
    public function getNext()
    {
        $next = $this->current();
        $this->next();

        return $next;
    }

    public function sort($by, $dir)
    {
        $this->sortBy = $by;
        $this->sortDir = $dir;

        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param array $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
        $this->hasExecuted = false;

        return $this;
    }

    /**
     * @return string
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @param string $sortBy
     * @return $this
     */
    public function setSortBy($sortBy)
    {
        $this->sortBy = $sortBy;
        $this->hasExecuted = false;

        return $this;
    }

    /**
     * @return string
     */
    public function getSortDir()
    {
        return $this->sortDir;
    }

    /**
     * @param string $sortDir
     * @return $this
     */
    public function setSortDir($sortDir)
    {
        $this->sortDir = $sortDir;
        $this->hasExecuted = false;

        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $limit = (int) $limit;

        if ($limit < 1) {
            $limit = null;
        }

        $this->limit = $limit;
        $this->hasExecuted = false;

        return $this;
    }
    
    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function filterBy($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->filterBy($k, $v);
            }
        } elseif ($value !== null) {
            $this->filters[$key] = $value;
        }

        return $this;
    }
}
