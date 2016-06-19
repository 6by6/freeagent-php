<?php

namespace SixBySix\Freeagent\Entity;

use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use SixBySix\Freeagent\OAuth2\Api;

class User extends AbstractEntity
{
    const API_RESOURCE_NAME = 'users';

    const API_ENTITY_NAME = 'user';

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $url;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $firstName;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $lastName;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $email;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $role;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $permissionLevel;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $openingMileage;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $updatedAt;

    /**
     * @Groups({"get"})
     * @Type("string")
     */
    protected $createdAt;

    /**
     * @Groups({"update", "post"})
     * @Type("string")
     */
    protected $password;

    /**
     * @Groups({"get", "update", "post"})
     * @Type("string")
     */
    protected $niNumber;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getPermissionLevel()
    {
        return $this->permissionLevel;
    }

    /**
     * @param mixed $permissionLevel
     */
    public function setPermissionLevel($permissionLevel)
    {
        $this->permissionLevel = $permissionLevel;
    }

    /**
     * @return mixed
     */
    public function getOpeningMileage()
    {
        return $this->openingMileage;
    }

    /**
     * @param mixed $openingMileage
     */
    public function setOpeningMileage($openingMileage)
    {
        $this->openingMileage = $openingMileage;
    }

    /**
     * @param mixed $niNumber
     */
    public function setNiNumber($niNumber)
    {
        $this->niNumber = $niNumber;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
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