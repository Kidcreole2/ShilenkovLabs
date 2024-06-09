<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SignInReq
{
    public function req_to_db($login){
        return (DB::select('select * from users where login = ?', $login));
    }
}
class SignUpReq
{
    public function req_to_db($login){
        return (DB::select('select * from users where login = ?', $login));
    }
}
class SignInDTO
{
    public $login;
    public $password;

    public function __construct($login) {
        Log::notice("im in User SignIn Class");
        $user = (new SignInReq())->req_to_db($login);
        $this->login = $user['login'];
        $this->password = $user['password'];
    }
}
class SignUpDTO
{
    public $login;
    public $password;

    public function __construct($login, $password) {
        Log::notice("im in User SignUp Class");
        $this->login = $login;
        $this->password = $password;
    }
}
class UsersDTO
{
    public $name;
    public $login;
    public $password;

    public function __construct($login) {
        Log::notice("im in User Class");
        $user = (new SignInReq())->req_to_db($login);
        $this->login = $user['login'];
        $this->password = $user['password'];
        $this->name = $user['name'];
    }
}
