<?php

namespace Controller;

use Service\Authentication\AuthenticationInterfaceService;
use Repository\ProductRepository;
use Repository\UserProductRepository;

class MainController
{
    private AuthenticationInterfaceService $authenticationService;
    private ProductRepository $productRepository;
    private UserProductRepository $userProductRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService, ProductRepository $productRepository, UserProductRepository $userProductRepository)
    {
        $this->authenticationService = $authenticationService;
        $this->productRepository = $productRepository;
        $this->userProductRepository = $userProductRepository;
    }

    public function pathToPage(): void
    {
        require_once './../View/main.php';
    }

    public function getMainPage(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $userId = $this->authenticationService->sessionOrCookie();

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