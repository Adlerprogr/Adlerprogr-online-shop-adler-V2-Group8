<?php

namespace Controller;

use Request\CartRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;
use Service\CartService;
use Repository\UserProductRepository;

class CartController
{
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;
    private CartService  $cartService;
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();
        $this->cartService = new CartService();
        $this->userProductRepository = new UserProductRepository();
    }

    public function pathToPage(): void
    {
        require_once './../View/cart.php';
    }

    public function getCart(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $userId = $this->authenticationService->sessionOrCookie();

        if (!$this->cartService->getTotalPrice($userId)) {
            $notification = 'Cart empty';
        }

        $totalQuantityPrice = $this->cartService->getTotalPrice($userId);

        require_once './../View/cart.php';
    }

    public function addProductCart(CartRequest $request): void // в main.php при отправке формы отправляется всегда количевство 1
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        if (empty($errors)) {
            $arr = $request->getBody();

            $userId = $this->authenticationService->sessionOrCookie();

            $this->cartService->addProduct($userId, $arr);

            header("Location: /main");
        }
    }

    public function deleteProduct(CartRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        if (empty($errors)) {
            $arr = $request->getBody();

//            $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//            $userId = $_COOKIE['user_id'];
            $userId = $this->authenticationService->sessionOrCookie();

            $this->cartService->deleteProduct($userId, $arr);

            header("Location: /main");
        }
    }
}