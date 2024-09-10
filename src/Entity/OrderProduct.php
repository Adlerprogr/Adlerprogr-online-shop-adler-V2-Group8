<?php

namespace Entity;

class OrderProduct
{
    private int $id;
    private User $user_id;
    private Product $product_id;
    private int $quantity;
    private Order $order_id;

    public function __construct(int $id, User $user_id, Product $product_id, int $quantity, Order $order_id)
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

    public function getUserId(): User
    {
        return $this->user_id;
    }

    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getProductId(): Product
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

    public function getOrderId(): Order
    {
        return $this->order_id;
    }

    public function setOrderId($order_id): void
    {
        $this->order_id = $order_id;
    }


}