<?php

namespace SixBySix\Freeagent\Tests\Entity;

use SixBySix\Freeagent\Entity\User;
use SixBySix\Freeagent\Tests\TestCase;

class UserTest extends AbstractEntityTest
{
    public function getApiMethodName()
    {
        return 'users';
    }

    public function getClassName()
    {
        return 'SixBySix\Freeagent\Entity\User';
    }

    public function deserializeProvider()
    {
        return [
            [
                [
                    'url' => "https://api.freeagent.com/v2/users/1",
                    'first_name' => "Development",
                    'last_name' => "Team",
                    'email' => "dev@example.com",
                    'role' => "Director",
                    'permission_level' => 8,
                    'opening_mileage' => 0,
                    'updated_at' => "2011-08-24T08:10:23Z",
                    'created_at' => "2011-07-28T11:25:11Z",
                ],
                [
                    'getUrl' => "https://api.freeagent.com/v2/users/1",
                    'getFirstName' => "Development",
                    'getLastName' => "Team",
                    'getEmail' => "dev@example.com",
                    'getRole' => "Director",
                    'getPermissionLevel' => 8,
                    'getOpeningMileage' => 0,
                ]
            ]
        ];
    }
}