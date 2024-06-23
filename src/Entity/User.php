<?php

namespace Entity;

class User
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $repeat_password;

    public function __construct(int $id, string $first_name, string $last_name, string $email, string $password, string $repeat_password)
    {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->repeat_password = $repeat_password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName($first_name): void
    {
        $this->first_name = $first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName($last_name): void
    {
        $this->last_name = $last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRepeatPassword(): string
    {
        return $this->repeat_password;
    }

    public function setRepeatPassword($repeat_password): void
    {
        $this->repeat_password = $repeat_password;
    }
}