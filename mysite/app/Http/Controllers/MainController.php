<?php

namespace App\Http\Controllers;
use App\Classes\SignInDTO;
use App\Classes\UsersDTO;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')){
            $form = ['login'=>$request->input('login')];
            $form += ['password'=>$request->input('password')];
            $user = new SignInDTO($form['login']);
            if ($user){
                if ($user->password == $form['password']){
                    return json_encode($user, 200);
                }
            }else{
                $error = null;
                if ($error) {
                    $error_massage = ['code'=>500];
                    $error_massage = ['massage'=>'This is error'];
                    return json_encode($error_massage);
                }
            }
        }
        return view('login');
    }
    public function registration(Request $request){
        if ($request->isMethod('post')){
            $form = ['login'=>$request->input('login')];
            $form += ['password'=>$request->input('password')];
            $form += ['name'=>$request->input('name')];
            Log::info($form['login']);
            $user = new UsersDTO($form['login']);
            if (!($user)){
                if ($user->password == $form['password']){
                    return json_encode($user, 200);
                }
            }else{
                $error = null;
                if ($error) {
                    $error_massage = ['code'=>500];
                    $error_massage = ['massage'=>'This is error'];
                    return json_encode($error_massage);
                }
            }
        }
        return view('registration');
    }
    public function home(){
        return view('home');
    }
    public function tokens_get(){
        $response = ['PHP Version:' => phpversion()];
        return json_encode($response);
    }
    public function tokens_remove(){
        return "Info page";
    }
    public function logout(){
        $response = ['PHP Version:' => phpversion()];
        return json_encode($response);
    }
}
