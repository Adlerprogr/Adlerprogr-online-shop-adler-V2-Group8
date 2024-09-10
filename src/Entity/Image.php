<?php

namespace Entity;

class Image
{
    private int $id;
    private string|null $imgUrl;

    public function __construct(int $id, string $imgUrl = null)
    {
        $this->id = $id;
        $this->imgUrl = $imgUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getImgUrl(): string|null
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): void
    {
        $this->imgUrl = $imgUrl;
    }


}