<?php

namespace App\Services\Auth\DTO;

class AuthDTO
{
    public function __construct(
        private string $username,
        private string $password
    ) {
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
}
