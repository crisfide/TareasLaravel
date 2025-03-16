<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Google\Client;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Str;

class FbAuthController extends Controller
{
    
    public function getAuthUrl()  {
        if (Auth::check()) {
            return redirect("todos");
        }
        
        return Socialite::driver('facebook')->redirect();

    }


    public function callback(Request $request){

        // $id = $userInfo->id;
        // $name = $userInfo->name;
        // $email = $userInfo->email;
        // $picture = $userInfo->picture;


        // $user = User::where("email",$email)->firstOrCreate(
        //     ["email"=>$email],
        //     ["name"=>$name,"email"=>$email,"password"=>Str::random(6)]
        // );

        //Auth::login($user);

        return redirect("todos");
        //return [$id,$name,$email,$picture, $user->password];
    }
}
