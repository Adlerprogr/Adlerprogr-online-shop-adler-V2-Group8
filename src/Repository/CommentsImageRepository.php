<?php

namespace Repository;

use Entity\Comments;
use Entity\CommentsImage;
use Entity\Image;
use Entity\Product;
use Entity\User;

class CommentsImageRepository extends Repository
{
    public function create($commentsId, $imgUrlId = null): void
    {
        $stmt = self::getPdo()->prepare("INSERT INTO comments_image (comments_id, image_id) VALUES (:comments_id ,:image_id)");
        $stmt->execute(['comments_id' => $commentsId, 'image_id' => $imgUrlId]);
    }

    public function getCommentsImage($productId)
    {
        $stmt = self::getPdo()->prepare("
        SELECT
            ci.id AS id,
            c.id AS comments_id, c.user_id, c.product_id, c.img_url, c.comments, c.datetime,
            u.id AS user_id, u.first_name, u.last_name, u.email, u.password, u.repeat_password,
            p.id AS product_id, p.name, p.description, p.price, p.img_url ,
            i.id AS image_id, i.img_url AS image
        FROM comments_image ci
            INNER JOIN comments c
                ON c.id = ci.comments_id
            INNER JOIN users u
                ON c.user_id = u.id
            INNER JOIN products p
                ON c.product_id = p.id
            INNER JOIN image i
                ON i.id = ci.image_id
        WHERE c.product_id = :product_id
        ");
        $stmt->execute(['product_id' => $productId]);

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

    public function hydrate(array $date): CommentsImage
    {
        return new CommentsImage(
            $date['id'],
            new Comments(
                $date['comments_id'],
                new User($date['user_id'], $date['first_name'], $date['last_name'], $date['email'], $date['password'], $date['repeat_password']),
                new Product($date['product_id'], $date['name'], $date['description'], $date['price'], $date['img_url']),
                $date['img_url'],
                $date['comments'],
                $date['datetime']
            ),
            new Image($date['image_id'], $date['image'])
        );
    }
}