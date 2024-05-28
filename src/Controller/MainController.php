<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;

class MainController
{
    private ProductRepository $productRepository;
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->userProductRepository = new UserProductRepository();
    }

    public function pathToPage(): void
    {
        require_once './../View/main.php';
    }

    public function getMainPage(): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        } else {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        }
        $userId = $_SESSION['user_id'];

        $products = $this->productRepository->getProducts(); // !!! object ProductRepository

        if (isset($products)) {
            $cartProducts = $this->userProductRepository->productsUserCart($userId); // !!! object UserProductRepository

            if (empty($cartProducts)) {
                $sumQuantity = 0;
            } else {
                $sumQuantity = 0;

                foreach ($cartProducts as $cartProduct) {
                    $sumQuantity += $cartProduct->getQuantity();
                }
            }
        }

        require_once './../View/main.php';
    }
}