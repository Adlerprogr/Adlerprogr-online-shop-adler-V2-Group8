<?php

namespace Controller;

use Repository\UserProductRepository;
use Request\CartRequest;

class CartController
{
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
    }

    public function pathToPage(): void
    {
        require_once './../View/cart.php';
    }

    public function getCart(): void
    {
        if (session_status() == PHP_SESSION_NONE) { // Проверяю была ли запудена сессия, если нет запускаю, если да то пропускаю
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
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $arr = $request->getBody();

        $userId = $_SESSION['user_id'];
        $productId = $arr['product_id'];
        $quantity = 1;

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        $checkProduct = $this->userProductRepository->checkProduct($userId, $productId); // !!! object UserProductRepository

        if (empty($errors)) {
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
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        $arr = $request->getBody();

        $userId = $_SESSION['user_id'];
        $productId = $arr['product_id'];
        $quantity = 1;

        $errors = $request->validate(); // Как использовать в cart.php if, else с foreach? Пока валидационные ошибки не выводяться в cart.php

        $checkProduct = $this->userProductRepository->checkProduct($userId, $productId); // !!! object UserProductRepository

        if (empty($errors)) {
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