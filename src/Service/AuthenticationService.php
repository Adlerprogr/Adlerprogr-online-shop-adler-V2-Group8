<?php

namespace Service;

use Repository\UserRepository;
use Entity\User;

class AuthenticationService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function check(): bool
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser(): User|null
    {
        if (!$this->check()) {
            return null;
        }

        $userId = $_SESSION['user_id'];

        return $this->userRepository->getUserById($userId);
    }

    public function authenticate(string $email, string $password): bool
    {
        $getEmail = $this->userRepository->getUserByEmail($email); // !!! object UserRepository

        if (!empty($getEmail)) {
            if (password_verify($password, $getEmail->getPassword())) {
                session_start();
                $_SESSION['user_id'] = $getEmail->getId();

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}