<?php

namespace Entity;

class Product
{
    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $img_url;

    public function __construct(int $id, string $name, string $description, float $price, string $img_url)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->img_url = $img_url;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function setDescription($description): void
    {
        $this->description = $description;
    }


    public function getPrice(): float
    {
        return $this->price;
    }


    public function setPrice($price): void
    {
        $this->price = $price;
    }


    public function getImgUrl(): string
    {
        return $this->img_url;
    }


    public function setImgUrl($img_url): void
    {
        $this->img_url = $img_url;
    }


}