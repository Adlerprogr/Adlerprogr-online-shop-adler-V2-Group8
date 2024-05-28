<?php

namespace Entity;

use Repository\ProductRepository;
use Repository\UserRepository;

class UserProduct
{
    private int $id;
    private User $userId;
    private Product $productId;
    private int $quantity;

    public function __construct(int $id, User $userId, Product $productId, int $quantity)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->productId = $productId;
        $this->quantity = $quantity;
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

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }


}