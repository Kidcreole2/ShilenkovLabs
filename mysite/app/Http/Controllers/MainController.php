<?php

namespace App\Http\Controllers;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')){
            return json_encode(200);
        }
        return view('login');
    }
    public function registration(){
        return view('registration');
    }
    public function home(){
        return view('home');
    }
    public function get_tokens(){
        $response = ['PHP Version:' => phpversion()];
        return json_encode($response);
    }
    public function get_users(){
        return "Info page";
    }
    public function logout(){
        $response = ['PHP Version:' => phpversion()];
        return json_encode($response);
    }
}
