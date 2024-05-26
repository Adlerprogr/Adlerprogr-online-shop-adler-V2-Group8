<?php

namespace Model;

class OrderProduct extends Model
{
    public function createOrderProduct(int $userId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO order_products (user_id, product_id, quantity, order_id) SELECT user_id, product_id, quantity FROM user_products WHERE user_id = :user_id UNION SELECT id FROM orders WHERE ");
        $stmt->execute(['user_id' => $userId]);

    }
}