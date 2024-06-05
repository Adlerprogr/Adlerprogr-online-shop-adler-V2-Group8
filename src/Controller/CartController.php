<?php

namespace Controller;

use Service\Authentication\AuthenticationInterfaceService;
use Service\CartService;
use Repository\UserProductRepository;
use Request\CartRequest;

class CartController
{
    private AuthenticationInterfaceService $authenticationService;
    private CartService  $cartService;
    private UserProductRepository $userProductRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
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

        $cartProducts = $this->userProductRepository->productsUserCart($userId); // !!! object UserProductRepository
        if (!$this->cartService->getTotalPrice($cartProducts)) {
            $notification = 'Cart empty';
        }

        $totalQuantityPrice = $this->cartService->getTotalPrice($cartProducts);

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

            $userId = $this->authenticationService->sessionOrCookie();

            $this->cartService->deleteProduct($userId, $arr);

            header("Location: /main");
        }
    }
}