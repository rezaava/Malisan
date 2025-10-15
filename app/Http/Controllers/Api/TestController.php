<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function test(){
        $user=new User();
        $user->name='a';
        $user->save();

        $user=User::find(1);
        Auth::login($user);

       $token = $user->createToken('test')->accessToken;
        return $token;



    }
    public function test2(Request $request){
        $u=Auth::user();
        return $u;
    }
}
