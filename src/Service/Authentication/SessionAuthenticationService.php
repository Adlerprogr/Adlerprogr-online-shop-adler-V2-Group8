<?php

namespace Service\Authentication;

use Entity\User;
use Repository\UserRepository;

class SessionAuthenticationService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
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

    public function sessionOrCookie(): int
    {
        if (isset($_COOKIE['user_id'])) {
            return $_COOKIE['user_id'];
        } else {
            return $_SESSION['user_id'];
        }
    }
}