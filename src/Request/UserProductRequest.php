<?php

namespace Request;

use Repository\ProductRepository;
use Repository\UserRepository;

class UserProductRequest extends Request
{
    private UserRepository $userRepository;
    private ProductRepository $productRepository;

    public function __construct(string $method, string $uri, array $headers, array $body)
    {
        parent::__construct($method, $uri, $headers, $body);

        $this->userRepository = new UserRepository();
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

    public function validate(): array
    {
        $errors = [];
        $arr = $this->body;

        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            $getUser = $this->userRepository->getUserById($userId); // !!! object UserRepository

            if (empty($userId)) {
                $errors['user_id'] = 'The user id should not be empty';
            } elseif ($getUser === null) {
                $errors['user_id'] = 'Such a user is not registered';
            }
        } else {
            $errors['user_id'] = 'UserRepository id must be filled';
        }

        if (isset($arr['product_id'])) {
            $productId = $arr['product_id'];

            $getProduct = $this->productRepository->getProductById($productId); // !!! object ProductRepository

            if (empty($productId)) {
                $errors['product_id'] = 'The product id should not be empty';
            } elseif ($getProduct === null) {
                $errors['product_id'] = 'There is no such product';
            }
        } else {
            $errors['product_id'] = 'The product id must be filled';
        }

        if (isset($arr['quantity'])) {
            $quantity = $arr['quantity'];

            if (empty($quantity)) {
                $errors['quantity'] = 'The quantity should not be empty';
            } elseif ($quantity <= 0) {
                $errors['quantity'] = 'The number must be greater than 0';
            }
        } else {
            $errors['quantity'] = 'The quantity must be filled';
        }

        return $errors;
    }
}