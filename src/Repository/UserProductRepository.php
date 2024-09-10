<?php

namespace Repository;

use Entity\User;
use Entity\Product;
use Entity\UserProduct;

class UserProductRepository extends Repository
{
    public function create(int $userId, int $productId, int $quantity): void
    {
        $stmt = self::getPdo()->prepare("INSERT INTO user_products (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function updateQuantity(int $userId, int $productId, int $quantity): void
    {
        $stmt = self::getPdo()->prepare("UPDATE user_products SET quantity = (quantity + :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function checkProduct(int $userId, int $productId): UserProduct|null
    {
        $stmt = self::getPdo()->prepare("
        SELECT 
            up.id AS id, up.quantity,
            u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
            p.id AS product_id, p.name, p.description, p.price, p.img_url
        FROM user_products up
            INNER JOIN users u 
                ON u.id = up.user_id 
            INNER JOIN products p 
                ON p.id = up.product_id
        WHERE u.id = :user_id AND p.id = :product_id
        ");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);

        $check = $stmt->fetch();

        if (empty($check)) {
            return null;
        }

        return $this->hydrate($check);
    }

    public function productsUserCart($userId): array|null
    {
        $stmt = self::getPdo()->prepare("
        SELECT 
            up.id AS id, up.quantity,
            u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
            p.id AS product_id, p.name, p.description, p.price, p.img_url
        FROM user_products up
            INNER JOIN users u 
                ON u.id = up.user_id 
            INNER JOIN products p 
                ON p.id = up.product_id
        WHERE u.id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);

        $products = $stmt->fetchAll();

        if (empty($products)) {
            return null;
        }

        $userProductArray = [];
        foreach ($products as $product) {
            $userProductArray[] = $this->hydrate($product);
        }

        return $userProductArray;
    }

    public function minusProduct(int $userId, int $productId, int $quantity): void
    {
        $stmt = self::getPdo()->prepare("UPDATE user_products SET quantity = (quantity - :quantity) WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'quantity' => $quantity]);
    }

    public function deleteProduct(int $userId, int $productId): void
    {
        $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id = :user_id AND product_id = :product_id");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId]);
    }

    public function allDeleteProduct(int $userId): void
    {
        $stmt = self::getPdo()->prepare("DELETE FROM user_products WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
    }

    public function hydrate(array $date): UserProduct
    {
        return new UserProduct(
            $date['id'],
            new User($date['user_id'], $date['first_name'], $date['last_name'], $date['email'], $date['password'], $date['repeat_password']),
            new Product($date['product_id'], $date['name'], $date['description'], $date['price'], $date['img_url']),
            $date['quantity']
        );
    }
}