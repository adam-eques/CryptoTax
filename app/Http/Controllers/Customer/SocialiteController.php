<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    /**
     * Create a new controller instance.
     *
     * @return Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|void
     */
    public function facebookCallback()
    {
        try {
            $socalialiteUser = Socialite::driver('facebook')->user();
            $user = User::where('fb_id', $socalialiteUser->id)->first();

            if ($user) {
                return $this->loginUser($user);
            } else {
                return $this->createUser($socalialiteUser, [
                    "fb_id" => $socalialiteUser->id
                ]);
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function googleCallback()
    {
        try {
            $socalialiteUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $socalialiteUser->id)->first();

            if ($user) {
                return $this->loginUser($user);
            } else {
                return $this->createUser($socalialiteUser, [
                    "google_id" => $socalialiteUser->id
                ]);
            }
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }


    protected function handleException(Exception $e)
    {
        session()->flash("error", $e->getMessage());

        return redirect(route("login"));
    }


    protected function loginUser(User $user)
    {
        Auth::login($user);

        return redirect(route("customer.dashboard"));
    }


    protected function createUser($socalialiteUser, array $data = [])
    {
        // Create user
        $userData = array_merge([
            'name' => $socalialiteUser->name,
            'email' => $socalialiteUser->email,
            'email_verified_at' => now(),
            'password' => encrypt(time()."@".rand(0, 777)),
        ], $data);
        $user = User::create($userData);

        // Login
        Auth::login($user);

        return redirect(route("customer.dashboard"));
    }
}
