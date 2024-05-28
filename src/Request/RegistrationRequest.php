<?php

namespace Request;

use Repository\UserRepository;

class RegistrationRequest extends Request
{
    private UserRepository $userRepository;

    public function __construct(string $method, string $uri, array $headers, array $body)
    {
        parent::__construct($method, $uri, $headers, $body);

        $this->userRepository = new UserRepository();
    }

    public function getFirstName()
    {
        return $this->body['firstName'];
    }

    public function getLastName()
    {
        return $this->body['lastName'];
    }

    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPassword()
    {
        return $this->body['password'];
    }

    public function getRepeatPassword()
    {
        return $this->body['repeat_password'];
    }

    public function validate():array
    {
        $errors = [];

        $arr = $this->body;

        if (isset($arr['first_name'])) {
            $firstName = $arr['first_name'];

            if (empty($firstName)) {
                $errors['first_name'] = 'FirstName not be empty';
            } elseif (strlen($firstName) < 2) {
                $errors['first_name'] = 'FirstName cannot have less than 2 characters';
            }
        } else {
            $errors['first_name'] = 'FirstName must be fill';
        }

        if (isset($arr['last_name'])) {
            $lastName = $arr['last_name'];

            if (empty($lastName)) {
                $errors['last_name'] = 'LastName not be empty';
            } elseif (strlen($lastName) < 2) {
                $errors['last_name'] = 'LastName cannot have less than 2 characters';
            }
        } else {
            $errors['last_name'] = 'LastName must be fill';
        }

        if (isset($arr['email'])) {
            $email = $arr['email'];

            $getEmail = $this->userRepository->getUserByEmail($email); // !!! object UserRepository

            if ($getEmail !== null) {
                $errors['email'] = 'UserController with such email already exists';
            } elseif (empty($email)) {
                $errors['email'] = 'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] = 'The length of the email must exceed 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email address';
            }
        } else {
            $errors['email'] = 'Email must be fill';
        }

        if (isset($arr['password'])) {
            $password = $arr['password'];

            if (empty($password)) {
                $errors['password'] = 'Password not be empty';
            } elseif (strlen($password) < 8) {
                $errors['password'] = 'Password cannot have less than 8 characters';
            }
        } else {
            $errors['password'] = 'Password must be fill';
        }

        if (isset($arr['repeat_password'])) {
            $repeatPassword = $arr['repeat_password'];

            if ($password !== $repeatPassword) {
                $errors['repeat_password'] = 'Repeat password not match';
            }
        } else {
            $errors['repeat_password'] = 'Repeat password must be fill';
        }

        return $errors;
    }
}