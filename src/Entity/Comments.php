<?php

namespace Entity;

class Comments
{
    private int $id;
    private User $userId;
    private Product $productId;
    private string $imgUrl;
    private string $comments;
    private string $dateTime;

    public function __construct(int $id, User $userId, Product $productId, string $imgUrl, string $comments, string $dateTime)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->imgUrl = $imgUrl;
        $this->comments = $comments;
        $this->dateTime = $dateTime;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): User
    {
        return $this->userId;
    }

    public function setUserId(User $userId): void
    {
        $this->userId = $userId;
    }

    public function getProductId(): Product
    {
        return $this->productId;
    }

    public function setProductId(Product $productId): void
    {
        $this->productId = $productId;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): void
    {
        $this->imgUrl = $imgUrl;
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }

    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }
}