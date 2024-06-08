<?php

namespace App\Http\Classes;

class SignIn_Req
{
    public function resource($login,$password){
        return 1;
    }
}
class SignUp_Req
{
    public function resource($login,$password){
        return 1;
    }
}
class SignIn_DTO
{
    public $login;
    public $password;

    public function __construct($form) {
        $this->login = $form['login'];
        $this->password = $form['password'];
    }
    public function signIn(){
        
    }
}
class SignUp_DTO
{
    public $login;
    public $password;

    public function __construct($login, $password) {
        $this->login = $login;
        $this->password = $password;
    }
}
class Users_DTO
{
    //
}
