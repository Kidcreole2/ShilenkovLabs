<?php

namespace App\Http\Controllers;
use Faker\Provider\UserAgent;

class InfoController extends Controller
{
    public function index(){
        return "Info page";
    }
    public function server(){
        $response = ['PHP Version:' => phpversion()];
        return json_encode($response);
    }
    public function client(){
        $response = ['ip'=> $_SERVER['REMOTE_ADDR']];
        $response += ['user agent:'=> $_SERVER['HTTP_USER_AGENT']];
        return json_encode($response);
    }
    public function database(){
        $response = ['server info:' => mysql_get_server_info()];
        return $response;
    }
}
