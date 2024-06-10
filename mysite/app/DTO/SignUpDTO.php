<?php

namespace App\DTO;


class SignUpDTO
{
    public $username;
    public $password;
    public $email;
    public $birthday;

    public function __construct($username, $password, $email, $birthday) 
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->birthday = $birthday;
    }
}
