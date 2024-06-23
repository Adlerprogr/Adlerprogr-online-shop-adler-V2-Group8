<?php

namespace Entity;

class OrderProduct
{
    private int $id;
    private int $user_id;
    private int $product_id;
    private int $quantity;
    private int $order_id;

    public function __construct(int $id, int $user_id, int $product_id, int $quantity, int $order_id)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->order_id = $order_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function setProductId($product_id): void
    {
        $this->product_id = $product_id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }


}