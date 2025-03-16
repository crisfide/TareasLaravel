<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Oauth2;
use App\Models\User;
use Str;

class GoogleAuthController extends Controller
{
    
    public function getAuthUrl()  {
        if (Auth::check()) {
            return redirect("todos");
        }
        
        $client = new Client();

        // Required, call the setAuthConfig function to load authorization credentials from
        // client_secret.json file.
        $client->setAuthConfig(base_path('config\google_auth\client_secret.json'));

        // Required, to set the scope value, call the addScope function
        //$client->addScope([Google\Service\Drive::DRIVE_METADATA_READONLY, Google\Service\Calendar::CALENDAR_READONLY]);
        $client->addScope(["email", "profile"]);

        // Required, call the setRedirectUri function to specify a valid redirect URI for the
        // provided client_id
        //$client->setRedirectUri('http://127.0.0.1:8000' . '/oauth2callback');
        $redirect_uri = route('googleCallback');
        $client->setRedirectUri($redirect_uri);

        // Recommended, offline access will give you both an access and refresh token so that
        // your app can refresh the access token without user interaction.
        $client->setAccessType('offline');

        // Recommended, call the setState function. Using a state value can increase your assurance that
        // an incoming connection is the result of an authentication request.
        ///$client->setState($sample_passthrough_value);

        // Optional, if your application knows which user is trying to authenticate, it can use this
        // parameter to provide a hint to the Google Authentication Server.
        ///$client->setLoginHint('hint@example.com');

        // Optional, call the setPrompt function to set "consent" will prompt the user for consent
        $client->setPrompt('consent');

        // Optional, call the setIncludeGrantedScopes function with true to enable incremental
        // authorization
        $client->setIncludeGrantedScopes(true);


        //Genera una URL para solicitar acceso desde el servidor de OAuth 2.0 de Google:
        $auth_url = $client->createAuthUrl();

        return redirect($auth_url);

        //Redirecciona al usuario a $auth_url:
        ///header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
    }


    public function callback(Request $request){
        /* http://127.0.0.1:8000/oauth2callback?
        // code=4%2F0AQSTgQEQXNWD7g4a5JW-cwIPwG80B2lIAGKtLq_H39416zzElgtvSgD3Ud8VH0szBUUUMg
        // &scope=email+profile+openid+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email
        // &authuser=1
        // &prompt=consent

        */
        
        if ($request->error || !$request->code) {
            return redirect("login")
                ->withErrors(["auth.fail"=>"$request->error"]);

        }

        $client = new Client();
        $client->setAuthConfig(base_path('config\google_auth\client_secret.json'));

        $access_token = $client->fetchAccessTokenWithAuthCode($request->code);

        $client->setAccessToken($access_token);

        $client->addScope(["email", "profile"]);

        $client->setIncludeGrantedScopes(true);
        $client->setAccessType("offline");

        // Generate a URL for authorization as it doesn't contain code and error

        $state = bin2hex(random_bytes(16));
        $client->setState($state);

        $refresh_token = $client->getRefreshToken();

        $oauth = new Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        $id = $userInfo->id;
        $name = $userInfo->name;
        $email = $userInfo->email;
        $picture = $userInfo->picture;


        $user = User::where("email",$email)->firstOrCreate(
            ["email"=>$email],
            ["name"=>$name,"email"=>$email,"password"=>null]
        );

        Auth::login($user);

        return redirect("todos");
        //return [$id,$name,$email,$picture, $user->password];
    }
}
