<?php

namespace Controller;

use Repository\UserRepository;
use Request\LoginRequest;
use Request\RegistrationRequest;

class UserController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function getRegistration(): void
    {
        require_once './../View/registration.php';
    }

    public function postRegistration(RegistrationRequest $request): void
    {
        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            $firstName = $arr['first_name'];
            $lastName = $arr['last_name'];
            $email = $arr['email'];
            $password = password_hash($arr['password'], PASSWORD_DEFAULT);
            $repeatPassword = password_hash($arr['repeat_password'], PASSWORD_DEFAULT);

            $this->userRepository->create($firstName, $lastName, $email, $password, $repeatPassword);
        }

        require_once './../View/login.php';
    }

    public function getLogin(): void
    {
        require_once './../View/login.php';
    }

    public function postLogin(LoginRequest $request): void
    {
        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $getEmail = $this->userRepository->getUserByEmail($email); // !!! object UserRepository

            if (!empty($getEmail)) {
                if (password_verify($password, $getEmail->getPassword())) {
                    session_start();
                    $_SESSION['user_id'] = $getEmail->getId();
                    header("Location: /main");
                } else {
                    echo 'The email or password is not correct';
                }
            } else {
                echo 'The email or password is not correct';
            }
        }

        require_once './../View/login.php';
    }
}