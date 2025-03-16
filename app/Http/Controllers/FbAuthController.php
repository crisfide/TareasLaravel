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
        // http://localhost:8000/fbCallback?
        // code=AQDH6Z2PZdpS2rCHWnJV3gGxfR8iTz1jL5DxF_HPO_bTFb-nedqvDTxSkGEWg6oZhMwDEPEdO8v0wW1WVv1G_LgkajGRztsJIObK2UjZ2ymy9wt7tFIB8Nolr7augM6exxSf9Eq30YOXRZSmNpUaKtIU5AIGzdgRLEVCY99FOA7xAjZT1Ub2MjsqOqJ_OPN51m-ktIflTQSLZdqj4I_MyErUG5mCuiyJe0sWXN48aK6FEDJGwHWEO_brHkKA63OI-AMFNgJFrzTlPoLqyUxryu9Gu40RxpfZnsvasS_Lq2x8jtNEmkrGlfnHSNggO5kdjUrl9Px0IW4IZ7KzRTD8gQJn-vW9jIuoJWNyNTUrQxBdGtsGA1-TaqEktq8Cq7EaQ5VLUegUd9yQxeGW4zvSvt0NmG4BzYsstIOKXCWFoap4QQ
        // &state=BXLOcaqRo1RK6qA873x5c97L29a9X1lTdVQBgMV8#_=_

        // http://localhost:8000/fbCallback?
        // error=access_denied
        // &error_code=200
        // &error_description=Permissions+error
        // &error_reason=user_denied
        // &state=9QhmO7wyqsxxyIP8RDCekC5kZy3FxuM6RqRswBzF#_=_

        if ($request->error || !$request->code) {
            return redirect("login")
                ->withErrors(["auth.fail"=>"$request->error: $request->error_reason"]);

        }

        $userFb = Socialite::driver('facebook')->user();

        $id = $userFb->id;
        $name = $userFb->name;
        $email = $userFb->email;
        $picture = $userFb->avatar;

        
        $user = User::where("email",$email)->firstOrCreate(
            ["email"=>$email],
            ["name"=>$name,"email"=>$email,"password"=>null]
        );

        Auth::login($user);

        return redirect("todos");
        //return [$id,$name,$email,$picture, $user->password];
    }
}
