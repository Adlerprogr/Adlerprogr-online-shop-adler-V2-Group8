<?php

namespace Request;

class OrderRequest extends Request
{
    public function getEmail()
    {
        return $this->body['email'];
    }

    public function getPhone()
    {
        return $this->body['phone'];
    }

    public function getName()
    {
        return $this->body['name'];
    }

    public function getAddress()
    {
        return $this->body['address'];
    }

    public function getCity()
    {
        return $this->body['city'];
    }

    public function getPostalCode()
    {
        return $this->body['postal_code'];
    }

    public function getCountry()
    {
        return $this->body['country'];
    }

    public function validate()
    {
        $errors = [];
        $arr = $this->body;

        if (isset($arr['email'])) {
            $email = $arr['email'];

            if (empty($email)) {
                $errors['email'] = 'Email not be empty';
            } elseif (strlen($email) < 2) {
                $errors['email'] = 'The length of the email must exceed 2 characters';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email address';
            }
        } else {
            $errors['email'] =  'Email must be fill';
        }

        if (isset($arr['phone'])) {
            $phone = $arr['phone'];

            if (empty($phone)) {
                $errors['phone'] = 'Phone number not be empty';
            } elseif (strlen($phone) !== 11) {
                $errors['phone'] = 'The length of the phone number must be equal to 11 characters';
            }  elseif (!in_array($phone[0], ['7'])) {
                $errors['phone'] = 'The phone number must start with the number 7';
            }
        } else {
            $errors['phone'] = 'The phone number must be filled';
        }

        if (isset($arr['name'])) {
            $name = $arr['name'];

            if (empty($name)) {
                $errors['name'] = 'Name not be empty';
            } elseif (strlen($name) < 2) {
                $errors['name'] = 'The length of the name must exceed 2 characters';
            } elseif (!preg_match('/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D', $name)) {
                $errors['name'] = 'Invalid user name';
            }
        } else {
            $errors['name'] = 'The name must be filled';
        }

        if (isset($arr['address'])) {
            $address = $arr['address'];

            if (empty($address)) {
                $errors['address'] = 'Address not be empty';
            } elseif (strlen($address) < 20) {
                $errors['address'] = 'The length of the address cannot be less than 20 characters';
            }
        } else {
            $errors['address'] = 'The address must be filled';
        }

        if (isset($arr['city'])) {
            $city = $arr['city'];

            if (empty($city)) {
                $errors['city'] = 'City not be empty';
            } elseif (strlen($city) < 2) {
                $errors['city'] = 'The length of the city must exceed 2 characters';
            }
        } else {
            $errors['city'] = 'The city must be filled';
        }

        if (isset($arr['postal_code'])) {
            $postal_code = $arr['postal_code'];

            if (empty($postal_code)) {
                $errors['postal_code'] = 'Postal Code not be empty';
            } elseif (!preg_match_all('/[0-9]/', $postal_code)) {
                $errors['postal_code'] = 'Incorrect postal code';
            } elseif (strlen($postal_code) !== 6) {
                $errors['postal_code'] = 'The zip code must contain 6 characters';
            }
        } else {
            $errors['postal_code'] = 'The postal code must be filled';
        }

        if (isset($arr['country'])) {
            $country = $arr['country'];

            if (empty($country)) {
                $errors['country'] = 'Country not be empty';
            } elseif (strlen($country) < 2) {
                $errors['country'] = 'The length of the country must exceed 2 characters';
            }
        } else {
            $errors['country'] = 'The country must be filled';
        }

        return $errors;
    }
}