<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use SixBySix\Freeagent\Entity\Task;
use SixBySix\Freeagent\Entity\Project;
use SixBySix\Freeagent\Entity\User;

class Timeslip extends AbstractEntity
{
    const API_RESOURCE_NAME = 'timeslips';

    const API_ENTITY_NAME = 'timeslip';

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @Groups({"get", "update", "post"})
     * @Accessor(getter="getUserUrl", setter="setUserUrl")
     * @Type("string")
     */
    protected $user;

    /**
     * @var User
     */
    protected $userEntity;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     * @Accessor(getter="getProjectUrl", setter="setProjectUrl")
     */
    protected $project;

    /**
     * @var  Project
     */
    protected $projectEntity;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     * @Accessor(getter="getTaskUrl", setter="setTaskUrl")
     */
    protected $task;

    /**
     * @var Task
     */
    protected $taskEntity;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     * @Accessor(getter="getBilledOnInvoiceUrl", setter="setBilledOnInvoiceUrl")
     */
    protected $billedOnInvoice;

    /**
     * @var Invoice
     */
    protected $billedOnInvoiceEntity;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $datedOn;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("double")
     */
    protected $hours;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $comment;

    /**
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $updatedAt;

    /**
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d\TH:i:s.uP'>")
     */
    protected $createdAt;

    /**
     * @return mixed
     */
    public function getUserUrl()
    {
        return $this->user;
    }

    public function getUser()
    {
        if (!$this->userEntity) {
            $this->userEntity = $this->getApi()->getOneResourceByUrl($this->getUserUrl());
        }

        return $this->userEntity;
    }

    /**
     * @param mixed $user
     */
    public function setUserUrl($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getProjectUrl()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProjectUrl($project)
    {
        $this->project = $project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    public function getProject()
    {
        if (!$this->projectEntity) {
            $this->projectEntity = $this->getApi()->getOneResourceByUrl($this->getProjectUrl());
        }

        return $this->projectEntity;
    }

    /**
     * @return mixed
     */
    public function getTaskUrl()
    {
        return $this->task;
    }

    public function setTaskUrl($taskUrl)
    {
        return $this->task = $taskUrl;
    }

    public function getTask()
    {
        if (!$this->taskEntity) {
            $this->taskEntity = $this->getApi()->getOneResourceByUrl($this->getTaskUrl());
        }

        return $this->userEntity;
    }

    /**
     * @return mixed
     */
    public function getDatedOn()
    {
        return $this->datedOn;
    }

    /**
     * @param mixed $datedOn
     */
    public function setDatedOn($datedOn)
    {
        $this->datedOn = $datedOn;
    }

    /**
     * @return mixed
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * @param mixed $hours
     */
    public function setHours($hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getBilledOnInvoice()
    {
        return $this->billedOnInvoice;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getApiResourceName()
    {
        return self::API_RESOURCE_NAME;
    }

    public function getApiEntityName()
    {
        return self::API_ENTITY_NAME;
    }
}