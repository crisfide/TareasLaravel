<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function show(){
        if (Auth::check()) {
            return redirect("todos");
        }
        return view("auth/register");
    }

    public function register(RegisterRequest $request){
        $user = User::create($request->validated());

        return redirect("login")->with("success", "Cuenta creada correctamente.");
    }
}
