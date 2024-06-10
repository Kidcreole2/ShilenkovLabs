<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InfoController extends Controller
{
    public function client(){
        return response()->json([
            phpinfo()
        ],200);
    }
    public function server(Request $request){
        return response()->json([
            $request->ip(),
            $request->useragent()
        ],200);
    }
    public function database(){
        return response()->json([
            'database' => DB::connection()->getDatabaseName()
        ],200);
    }
}
