<?php

namespace Controller;

use Service\Authentication\AuthenticationInterfaceService;
use Service\CartService;
use Repository\ProductRepository;
use Request\UserProductRequest;

class UserProductController
{
    private AuthenticationInterfaceService $authenticationService;
    private CartService $cartService;
    private ProductRepository $productRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService, CartService $cartService, ProductRepository $productRepository)
    {
        $this->authenticationService = $authenticationService;
        $this->cartService = $cartService;
        $this->productRepository = $productRepository;
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