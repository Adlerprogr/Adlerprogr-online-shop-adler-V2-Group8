<?php

namespace Controller;

use Repository\UserProductRepository;
use Request\CartRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;

class CartController
{
    private UserProductRepository $userProductRepository;
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();
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

//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
        $userId = $this->authenticationService->sessionOrCookie();

        $cartProducts = $this->userProductRepository->productsUserCart($userId); // !!! object UserProductRepository

        if (empty($cartProducts)) {
            echo 'The basket is empty'; // Как использовать в cart.php if, else с foreach?
        } else {
            $sumQuantity = 0;
            $sumPrice = 0;

            foreach ($cartProducts as $cartProduct) {
                $sumQuantity += $cartProduct->getQuantity();
                $sumPrice += $cartProduct->getQuantity() * $cartProduct->getProductId()->getPrice();
            }
        }

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

//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
            $userId = $this->authenticationService->sessionOrCookie();
            $productId = $arr['product_id'];
            $quantity = 1;

            $checkProduct = $this->userProductRepository->checkProduct($userId, $productId); // !!! object UserProductRepository

            if (empty($checkProduct)) {
                $this->userProductRepository->create($userId, $productId, $quantity);
            } else {
                $this->userProductRepository->updateQuantity($userId, $productId, $quantity);
            }

            header("Location: /main");
        }
    }

    public function deleteProduct(CartRequest $request):void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        if (empty($errors)) {
            $arr = $request->getBody();

//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
            $userId = $this->authenticationService->sessionOrCookie();
            $productId = $arr['product_id'];
            $quantity = 1;

            $checkProduct = $this->userProductRepository->checkProduct($userId, $productId); // !!! object UserProductRepository

            if (!empty($checkProduct)) {
                if ($checkProduct->getQuantity() === 1) {
                    $this->userProductRepository->deleteProduct($userId, $productId);
                } else {
                    $this->userProductRepository->minusProduct($userId, $productId, $quantity);
                }
            } // сделать else

            header("Location: /main");
        }
    }
}