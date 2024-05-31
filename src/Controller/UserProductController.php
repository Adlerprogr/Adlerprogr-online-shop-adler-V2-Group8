<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Request\UserProductRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;

class UserProductController
{
    private ProductRepository $productRepository;
    private UserProductRepository $userProductRepository;
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
        $this->userProductRepository = new UserProductRepository();
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();

    }

    public function getProducts(): void
    {
        require_once './../View/add_product.php';
    }

    public function postAddProduct(UserProductRequest $request): void
    {
        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            if (!$this->authenticationService->check()) {
                header("Location: /login");
            }

//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
            $userId = $this->authenticationService->sessionOrCookie();
            $productId = $arr['product_id'];
            $quantity = $arr['quantity'];

            $check = $this->userProductRepository->checkProduct($userId, $productId);

            if (empty($check)) {
                $this->userProductRepository->create($userId, $productId, $quantity);
            } else {
                $this->userProductRepository->updateQuantity($userId, $productId, $quantity);
            }
        }

        require_once './../View/add_product.php';
    }

    public function addingProducts(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $checkProducts = $this->productRepository->getProducts(); // !!! object ProductRepository

        if (empty($checkProducts)) {
            echo 'Are no checkProducts';
        }

        require_once './../View/add_product.php';
    }
}