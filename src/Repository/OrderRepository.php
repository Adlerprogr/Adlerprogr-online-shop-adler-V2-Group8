<?php

namespace Repository;

class OrderRepository extends Repository
{
    public function createOrder(string $email, int $phone, string $name, string $address, string $city, string $postal_code, string $country): void
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO 
                orders (email, phone, name, address, city, postal_code, country) 
            VALUES 
                (:email, :phone, :name, :address, :city, :postal_code, :country)
        ");
        $stmt->execute(['email' => $email, 'phone' => $phone, 'name' => $name, 'address' => $address, 'city' => $city, 'postal_code' => $postal_code, 'country' => $country]);
    }

    public function getOrderId(): false|string
    {
        return $this->pdo->lastInsertId();
    }
}