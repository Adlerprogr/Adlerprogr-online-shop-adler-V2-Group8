<?php

namespace Request;

use Repository\ProductRepository;

class CartRequest extends Request
{
    private ProductRepository $productRepository;

    public function __construct(string $method, string $uri, array $headers, array $body)
    {
        parent::__construct($method, $uri, $headers, $body);

        $this->productRepository = new ProductRepository();
    }

    public function getUserId()
    {
        return $this->body['user_id'];
    }

    public function getProductId()
    {
        return $this->body['product_id'];
    }

    public function getQuantity()
    {
        return $this->body['quantity'];
    }

    public function validate(): array // волидация не активна, смотри выше!
    {
        $errors = [];
        $arr = $this->body;

        if (isset($arr['product_id'])) {
            $getProduct = $this->productRepository->getProductById($arr['product_id']); // !!! object ProductRepository

            if (empty($arr['product_id'])) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($getProduct === null) {
                $errors['product_id'] = 'There is no such product';
            }
        } else {
            $errors['product_id'] = 'The product id must be filled';
        }

        if (isset($arr['quantity'])) {
            if (empty($arr['quantity'])) {
                $errors['quantity'] = 'The quantity should not be empty';
            } elseif ($arr['quantity'] <= 0) {
                $errors['quantity'] = 'The number must be greater than 0';
            }
        } else {
            $errors['quantity'] = 'The quantity must be filled';
        }

        return $errors;
    }
}