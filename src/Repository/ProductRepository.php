<?php

namespace Repository;

use Entity\Product;

class ProductRepository extends Repository
{
    public function getProducts(): array|null
    {
        $stmt = self::getPdo()->query("SELECT * FROM products");
        $products = $stmt->fetchAll();

        if (empty($products)) {
            return null;
        }

        $productEntity = [];
        foreach ($products as $product) {
            $productEntity[] = $this->hydrate($product);
        }

        return $productEntity;
    }

    public function getProductById(int $productId): Product|null
    {
        $stmt = self::getPdo()->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $productId]);
        $getProduct = $stmt->fetch();

        if (empty($getProduct)) {
            return null;
        }

        return $this->hydrate($getProduct);
    }

    public function hydrate(array $date): Product
    {
        return new Product($date['id'], $date['name'], $date['description'], $date['price'], $date['img_url']);
    }
}