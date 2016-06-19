<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * Class CapitalAsset
 * @package SixBySix\Freeagent\Entity
 * @see https://dev.freeagent.com/docs/capital_assets
 */
class CapitalAsset extends AbstractEntity
{
    const API_RESOURCE_NAME = 'capital_assets';
    const API_ENTITY_NAME = 'capital_asset';

    protected $x;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $description;

    /**
     * @var integer
     * @Groups({"get"})
     * @Type("integer")
     */
    protected $assetLifeYears;

    /**
     * @var string
     * @Groups({"get"})
     * @Type("string")
     */
    protected $assetType;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $purchasedOn;

    /**
     * @var \DateTime
     * @Groups({"get"})
     * @Type("DateTime<'Y-m-d'>")
     */
    protected $disposedOn;

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getAssetLifeYears()
    {
        return $this->assetLifeYears;
    }

    /**
     * @return string
     */
    public function getAssetType()
    {
        return $this->assetType;
    }

    /**
     * @return \DateTime
     */
    public function getPurchasedOn()
    {
        return $this->purchasedOn;
    }

    /**
     * @param \DateTime $purchasedOn
     */
    public function setPurchasedOn(\DateTime $purchasedOn)
    {
        $this->purchasedOn = $purchasedOn;
    }

    /**
     * @return \DateTime
     */
    public function getDisposedOn()
    {
        return $this->disposedOn;
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
}