<?php

namespace Controller;

use Service\Authentication\AuthenticationInterfaceService;
use Service\CartService;
use Repository\ProductRepository;
use Repository\UserProductRepository;
use Request\UserProductRequest;

class UserProductController
{
    private AuthenticationInterfaceService $authenticationService;
    private CartService $cartService;
    private ProductRepository $productRepository;
    private UserProductRepository $userProductRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
        $this->cartService = new CartService();
        $this->productRepository = new ProductRepository();
        $this->userProductRepository = new UserProductRepository();
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

            $userId = $this->authenticationService->sessionOrCookie();

            $this->cartService->addProduct($userId, $arr);
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