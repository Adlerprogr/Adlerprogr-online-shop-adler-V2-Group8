<?php

namespace Request;

class LoginRequest extends Request
{
    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPassword()
    {
        return $this->body['password'];
    }

    public function validate(): array
    {
        $errors = [];

        $arr = $this->body;

        if (isset($arr['email'])) {
            $email = $arr['email'];

            if (empty($email)) {
                $errors['email'] =  'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] =  'Email cannot have less than 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] =  'Invalid email address';
            }
        } else {
            $errors['email'] =  'Email must be fill';
        }

        if (isset($arr['password'])) {
            $password = $arr['password'];

            if (empty($password)) {
                $errors['password'] =  'Password not be empty';
            }
        } else {
            $errors['password'] =  'Password must be fill';
        }

        return $errors;
    }
}