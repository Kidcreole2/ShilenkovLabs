<?php

namespace App\Http\Controllers;
use App\Classes\SignInDTO;
use App\Classes\SignInReq;
use App\Classes\SignUpReq;
use App\Classes\UsersDTO;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('post')){
            $form = ['login'=>$request->input('login')];
            $form += ['password'=>$request->input('password')];

            Log::info($form['login']);

            $user_in_db = new UsersDTO($form['login']);

            if ($user_in_db){
                $user_sign_in = (new SignInReq)->getInf($form['login'],$form['password']);
                if ($user_sign_in->password==$user_in_db->password){
                    return view('home');
                }else{
                    $error = null;
                    if ($error) {
                        $error_massage = ['code'=>500];
                        $error_massage = ['massage'=>'Wrong password'];
                        return json_encode($error_massage);
                    }
                    $token = $request->user()->createToken($request->token_name);

                    return ['token' => $token->plainTextToken]; 
                }
            }else{
                $error = null;
                if ($error) {
                    $error_massage = ['code'=>500];
                    $error_massage = ['massage'=>'Wrong login'];
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

            $user_in_db = new UsersDTO($form['login']);
            Log::info($user_in_db->login);

            if (!($user_in_db->login)){
                Log::info("Im here");
                $user = (new SignUpReq)->getInf($form['login'],$form['password'],$form['name']);
                Log::info($user->name);
                DB::table('users')->insert([
                    'login' => $user->login,
                    'password' => $user->password,
                    'name' => $user->name
                ]);
            }else{
                $error = null;
                if ($error) {
                    $error_massage = ['code'=>500];
                    $error_massage = ['massage'=>'User with this login already exists'];
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
