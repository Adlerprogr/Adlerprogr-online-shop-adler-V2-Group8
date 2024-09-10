<?php

namespace Repository;

use Entity\OrderProduct;
use Entity\User;
use Entity\Product;
use Entity\Order;

class OrderProductRepository extends Repository
{
    public function createOrderProduct(int $userId, int $orderId): void
    {
        $stmt = self::getPdo()->prepare("
            INSERT INTO 
                order_products (user_id, product_id, quantity, order_id) 
            SELECT 
                user_id, product_id, quantity, :order_id 
            FROM 
                user_products 
            WHERE 
                user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId, 'order_id' => $orderId]);
    }

    public function checkOrderProduct(int $userId, int $productId)
    {
        $stmt = self::getPdo()->prepare("
        SELECT 
            op.id AS id, op.quantity, 
            u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
            p.id AS product_id, p.name, p.description, p.price, p.img_url, 
            o.id AS order_id, o.email, o.phone, o.name, o.address, o.city, o.postal_code, o.country
        FROM order_products op
            INNER JOIN users u 
                ON u.id = op.user_id 
            INNER JOIN products p 
                ON p.id = op.product_id
            INNER JOIN orders o
                ON o.id = op.order_id
        WHERE u.id = :user_id AND p.id = :product_id
        ");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $check = $stmt->fetchAll();

        if (empty($check)) {
            return null;
        }

        $commentsArray = [];
        foreach ($check as $checks) {
            $commentsArray[] = $this->hydrate($checks);
        }

        return $commentsArray;
    }

    public function hydrate(array $date): OrderProduct
    {
        return new OrderProduct(
            $date['id'],
            new User($date['user_id'], $date['first_name'], $date['last_name'], $date['email'], $date['password'], $date['repeat_password']),
            new Product($date['product_id'], $date['name'], $date['description'], $date['price'], $date['img_url']),
            $date['quantity'],
            new Order($date['order_id'], $date['email'], $date['phone'], $date['name'], $date['address'], $date['city'], $date['postal_code'], $date['country'])
        );
    }
}