<?php

namespace Entity;

class Order
{
    private int $id;
    private string $email;
    private string $phone;
    private string $name;
    private string $address;
    private string $city;
    private string $postal_code;
    private string $country;

    public function __construct(int $id, string $email, string $phone, string $name, string $address, string $city, string $postal_code, string $country)
    {
        $this->id = $id;
        $this->email = $email;
        $this->phone = $phone;
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->postal_code = $postal_code;
        $this->country = $country;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity($city): void
    {
        $this->city = $city;
    }

    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    public function setPostalCode($postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry($country): void
    {
        $this->country = $country;
    }


}