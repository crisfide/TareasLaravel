<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    
    public function show(){
        if (Auth::check()) {
            return redirect("todos");
        }
        return view("auth/login");
    }

    public function login(LoginRequest $request){
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) {
            return redirect("login")->withErrors(["auth.fail"=>"Error"]);
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user);

        return $this->authenticated($request,$user);
    }

    public function authenticated($request,$user){
        return redirect("todos");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect("/");
    }
}
