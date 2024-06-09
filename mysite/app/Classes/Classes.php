<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SignInReq
{
    public function getInf($login,$password){
        return (new SignInDTO($login,$password));
    }
}
class SignUpReq
{
    public function getInf($login,$password,$name){
        return (new SignUpDTO($login,$password,$name));
    }
}
class SignInDTO
{
    public $login;
    public $password;

    public function __construct($login,$password) {
        $this->login = $login;
        $this->password = $password;
    }
}
class SignUpDTO
{
    public $login;
    public $password;
    public $name;

    public function __construct($login, $password,$name) {
        Log::notice("im in User SignUp Class");
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
    }
}
class UsersDTO
{
    public $id;
    public $login;
    public $password;
    public $name;

    public function __construct($login) {
        Log::notice("im in User Class");
        $user = DB::table('users')->where('login', $login)->first();
        if ($user){
            $this->id = $user->id;
            $this->login = $user->login;
            $this->password = $user->password;
            $this->name = $user->name;
        }
    }
}
