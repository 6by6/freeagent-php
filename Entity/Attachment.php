<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class Attachment
 * @see https://dev.freeagent.com/docs/attachments
 * @package SixBySix\Freeagent\Entity
 */
class Attachment extends AbstractEntity
{
    const API_RESOURCE_NAME = 'attachments';
    const API_ENTITY_NAME = 'attachment';

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"post","update"})
     * @Type("string")
     */
    protected $data;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $contentSrc;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $contentType;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $fileName;

    /**
     * @var integer
     * @Groups({"get"})
     * @Type("integer")
     */
    protected $fileSize;

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
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getContentSrc()
    {
        return $this->contentSrc;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return int
     */
    public function getFileSize()
    {
        return $this->fileSize;
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
}
