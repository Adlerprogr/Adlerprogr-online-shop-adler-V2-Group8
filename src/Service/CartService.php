<?php

namespace Service;

use Repository\UserProductRepository;

class CartService
{
    private UserProductRepository $userProductRepository;

    public function __construct()
    {
        $this->userProductRepository = new UserProductRepository();
    }

    public function addProduct(int $userId, array $arr): void
    {
        $checkProduct = $this->userProductRepository->checkProduct($userId, $arr['product_id']); // !!! object UserProductRepository

        if (empty($checkProduct)) {
            $this->userProductRepository->create($userId, $arr['product_id'], $arr['quantity']);
        } else {
            $this->userProductRepository->updateQuantity($userId, $arr['product_id'], $arr['quantity']);
        }
    }

    public function getTotalPrice(array $cartProducts): array|false
    {

        if (!empty($cartProducts)) {
            $sumQuantity = 0;
            $sumPrice = 0;

            foreach ($cartProducts as $cartProduct) {
                $sumQuantity += $cartProduct->getQuantity();
                $sumPrice += $cartProduct->getQuantity() * $cartProduct->getProductId()->getPrice();
            }

            $totalPrice = ['sum_quantity' => $sumQuantity, 'sum_price' => $sumPrice];

            return $totalPrice;
        } else {
            return false;
        }
    }

    public function deleteProduct(int $userId, array $arr): void
    {
        $checkProduct = $this->userProductRepository->checkProduct($userId, $arr['product_id']); // !!! object UserProductRepository

        if (!empty($checkProduct)) {
            if ($checkProduct->getQuantity() === 1) {
                $this->userProductRepository->deleteProduct($userId, $arr['product_id']);
            } else {
                $this->userProductRepository->minusProduct($userId, $arr['product_id'], $arr['quantity']);
            }
        } // сделать else
    }
}