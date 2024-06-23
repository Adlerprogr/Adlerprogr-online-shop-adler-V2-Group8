<?php

namespace Service;

use Repository\UserProductRepository;

class CartService
{
    private UserProductRepository $userProductRepository;

    public function __construct(UserProductRepository $userProductRepository)
    {
        $this->userProductRepository = $userProductRepository;
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

    public function getTotalPrice(array|null $cartProducts): array
    {
        $sumQuantity = 0;
        $sumPrice = 0;

        if (!empty($cartProducts)) {

            foreach ($cartProducts as $cartProduct) {
                $sumQuantity += $cartProduct->getQuantity();
                $sumPrice += $cartProduct->getQuantity() * $cartProduct->getProductId()->getPrice();
            }

            $totalPrice = ['sum_quantity' => $sumQuantity, 'sum_price' => $sumPrice];

            return $totalPrice;
        } else {
            $totalPrice = ['sum_quantity' => $sumQuantity, 'sum_price' => $sumPrice];

            return $totalPrice;
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