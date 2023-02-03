<?php

namespace App\Entities;

use App\Models\User;
use Laravel\Sanctum\NewAccessToken;

class UserWithAccessToken
{
    public function __construct(
        private NewAccessToken $accessToken,
        private User $user,
    )
    {}

    /**
     * @return NewAccessToken
     */
    public function getAccessToken(): NewAccessToken
    {
        return $this->accessToken;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
