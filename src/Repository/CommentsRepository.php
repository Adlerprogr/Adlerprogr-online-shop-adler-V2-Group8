<?php

namespace Repository;

use Adler\Corepackege\Repository;
use Entity\Comments;
use Entity\Product;
use Entity\User;

class CommentsRepository extends Repository
{
    public function create(int $userId, int $productId, string $comments, string $imgUrl = null): void
    {
        $stmt = self::getPdo()->prepare("INSERT INTO comments (user_id, product_id, comments, img_url) VALUES (:user_id, :product_id, :comments, :img_url)");
        $stmt->execute(['user_id' => $userId, 'product_id' => $productId, 'comments' => $comments, 'img_url' => $imgUrl]);
    }

    public function getCommentsId(): false|string
    {
        return self::getPdo()->lastInsertId();
    }

    public function displayingComments(int $userId, int $productId): array|null
    {
        $stmt = self::getPdo()->prepare("
        SELECT 
            c.id AS id, c.img_url, c.comments, c.datetime, 
            u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password, 
            p.id AS product_id, p.name, p.description, p.price, p.img_url
        FROM comments c
            INNER JOIN users u 
                ON u.id = c.user_id 
            INNER JOIN products p 
                ON p.id = c.product_id
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

    public function hydrate(array $date): Comments
    {
        return new Comments(
            $date['id'],
            new User($date['user_id'], $date['first_name'], $date['last_name'], $date['email'], $date['password'], $date['repeat_password']),
            new Product($date['product_id'], $date['name'], $date['description'], $date['price'], $date['img_url']),
            $date['img_url'],
            $date['comments'],
            $date['datetime']
        );
    }
}