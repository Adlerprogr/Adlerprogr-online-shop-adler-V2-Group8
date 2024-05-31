<?php

namespace Controller;

use Repository\ProductRepository;
use Repository\UserProductRepository;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;

class MainController
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

    public function pathToPage(): void
    {
        require_once './../View/main.php';
    }

    public function getMainPage(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
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