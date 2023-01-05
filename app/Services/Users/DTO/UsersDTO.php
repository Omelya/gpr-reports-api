<?php

namespace App\Services\Users\DTO;

class UsersDTO
{
    private string $username;
    private string $password;
    private string $firstName;
    private string $lastName;
    private string $fatherName;
    private string $birthday;
    private string $position;
    private string $rank;

    public function __construct(
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        string $fatherName,
        string $birthday,
        string $position,
        string $rank
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->fatherName = $fatherName;
        $this->birthday = $birthday;
        $this->position = $position;
        $this->rank = $rank;
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

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFatherName(): string
    {
        return $this->fatherName;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }
}
