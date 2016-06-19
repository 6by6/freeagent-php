<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\Entity\AbstractEntity;
use SixBySix\Freeagent\Entity\Project;

/**
 * Class Task
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/tasks
 */
class Task extends AbstractEntity
{
    const API_RESOURCE_NAME = 'tasks';
    const API_ENTITY_NAME = 'task';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"get"})
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     * @Type("string")
     */
    protected $project;

    /**
     * @var Project
     */
    protected $projectEntity;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $name;

    /**
     * @var bool
     * @Groups({"update", "post", "get"})
     * @Type("boolean")
     */
    protected $isBillable;

    /**
     * @var float
     * @Groups({"update", "post", "get"})
     * @Type("double")
     */
    protected $billingRate;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $billingPeriod;

    /**
     * @var string
     * @Groups({"update", "post", "get"})
     * @Type("string")
     */
    protected $status;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $createdAt;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $updatedAt;

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
    public function getProjectUrl()
    {
        return $this->project;
    }

    /**
     * @param string $project
     */
    public function setProjectUrl($project)
    {
        $this->project = $project;
    }

    /**
     * @return Project
     */
    public function getProject()
    {
        if (!$this->projectEntity) {
            $this->projectEntity = $this->getApi()->getOneResourceByUrl($this->getProjectUrl());
        }

        return $this->projectEntity;
    }

    /**
     * @param Project $project
     */
    public function setProject(Project $project)
    {
        $this->projectEntity = $project;
        $this->project = $project->getUrl();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function getIsBillable()
    {
        return $this->isBillable;
    }

    /**
     * @param bool $isBillable
     */
    public function setIsBillable($isBillable)
    {
        $this->isBillable = $isBillable;
    }

    /**
     * @return float
     */
    public function getBillingRate()
    {
        return $this->billingRate;
    }

    /**
     * @param float $billingRate
     */
    public function setBillingRate($billingRate)
    {
        $this->billingRate = $billingRate;
    }

    /**
     * @return string
     */
    public function getBillingPeriod()
    {
        return $this->billingPeriod;
    }

    /**
     * @param string $billingPeriod
     */
    public function setBillingPeriod($billingPeriod)
    {
        $this->billingPeriod = $billingPeriod;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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

    /**
     * @return string
     */
    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    /**
     * @return string
     */
    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }

    /**
     * @return string
     */
    public function getPostUrl()
    {
        return $this->getApi()->getUrl($this->getApiResourceName(), [
            'project' => $this->getProjectUrl(),
        ]);
    }
}