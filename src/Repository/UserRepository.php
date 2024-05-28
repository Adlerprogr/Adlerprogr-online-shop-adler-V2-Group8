<?php

namespace Repository;

use Entity\User;

class UserRepository extends Repository
{
    public function create(string $firstName, string $lastName, string $email, $password, $repeatPassword): void
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (first_name, last_name, email, password, repeat_password) VALUES (:first_name, :last_name, :email, :password, :repeat_password)");
        $stmt->execute(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'password' => $password, 'repeat_password' => $repeatPassword]);
    }

    public function getUserByEmail(string $email): User|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if (empty($user)) {
            return null;
        }

        return $this->hydrate($user);
    }

    public function getUserById(int $userId): User|null
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $getUser = $stmt->fetch();

        if (empty($getUser)) {
            return null;
        }

        return $this->hydrate($getUser);
    }

    public function hydrate(array $data): User
    {
        return new User($data['id'], $data['first_name'], $data['last_name'], $data['email'], $data['password'], $data['repeat_password']);
    }
}