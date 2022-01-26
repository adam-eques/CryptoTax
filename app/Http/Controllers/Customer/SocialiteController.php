<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();

            if($isUser){
                Auth::login($isUser);
                return redirect('/dashboard');
            }else{
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'password' => encrypt('admin@123')
                ]);

                Auth::login($createUser);
                return redirect('/dashboard');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }


    ///**
    // * Create a new controller instance.
    // *
    // * @return void
    // */
    //public function redirectToGoogle()
    //{
    //    return Socialite::driver('google')->redirect();
    //}
    //
    ///**
    // * Create a new controller instance.
    // *
    // * @return void
    // */
    //public function handleGoogleCallback()
    //{
    //    try {
    //
    //        $user = Socialite::driver('google')->user();
    //
    //        $finduser = User::where('google_id', $user->id)->first();
    //
    //        if($finduser){
    //
    //            Auth::login($finduser);
    //
    //            return redirect()->intended('dashboard');
    //
    //        }else{
    //            $newUser = User::create([
    //                'name' => $user->name,
    //                'email' => $user->email,
    //                'google_id'=> $user->id,
    //                'password' => encrypt('123456dummy')
    //            ]);
    //
    //            Auth::login($newUser);
    //
    //            return redirect()->intended('dashboard');
    //        }
    //
    //    } catch (Exception $e) {
    //        dd($e->getMessage());
    //    }
    //}
}
