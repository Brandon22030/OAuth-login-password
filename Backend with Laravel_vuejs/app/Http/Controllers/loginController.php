<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class loginController extends Controller
{

// GITHUB OAUTH
    public function redirectToGithub(){

        return Socialite::driver('github')->redirect();

    }

    public function handleGithubCallback(){

        $user = Socialite::driver('github')->user();


        $data = User::where('email', $user->email)->first();

        if(is_null($data)){

            $users['name'] = $user->nickname;

            $users['email'] = $user->email;

            $users['password'] = bcrypt("password");
            
            $users['auth_type'] = 'Github';

            $data = User::create($users);

        };

        Auth::login($data);

        return redirect('dashboard');

    }


// GOOGLE OAUTH
    public function redirectToGoogle(){

        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback(){

        $user = Socialite::driver('google')->user();

        $data = User::where('email', $user->email)->first();

        if(is_null($data)){

            $users['name'] = $user->name;

            $users['email'] = $user->email;

            $users['auth_type'] = 'Google';

            $data = User::create($users);

        };

        Auth::login($data);

        return redirect('dashboard');

    }

// LINKEDIN OAUTH
    public function redirectToLinkedin(){

        return Socialite::driver('linkedin-openid')->redirect()     ;

    }

    public function handleLinkedinCallback(){

        $user = Socialite::driver('linkedin-openid')->user();

        $data = User::where('email', $user->email)->first();

        if(is_null($data)){

            $users['name'] = $user->name;

            $users['email'] = $user->email;

            $users['auth_type'] = 'Linkedin';

            $data = User::create($users);

        };

        Auth::login($data);

        return redirect('dashboard');

    }

// FACEBOOK OAUTH
        public function redirectToFacebook(){

            return Socialite::driver('facebook')->redirect();
    
        }
    
        public function handleFacebookCallback(){
    
            $user = Socialite::driver('facebook')->user();

            dd($user);
    
            // $data = User::where('email', $user->email)->first();
    
            // if(is_null($data)){
    
            //     $users['name'] = $user->name;
    
            //     $users['email'] = $user->email;
    
            //     $data = User::create($users);
    
            // };
    
            // Auth::login($data);
    
            // return redirect('dashboard');
    
        }

}
