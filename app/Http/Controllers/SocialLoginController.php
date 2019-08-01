<?php

namespace App\Http\Controllers;

use App\SocialAccountService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param SocialAccountService $service
     * @param $social
     * @return \Illuminate\Http\Response|\Exception
     */
    public function handleProviderCallback(SocialAccountService $service, $social)
    {
        try{
            $user = $service->setOrGetUser(Socialite::driver($social));
            if(! $user->active){
                return redirect()->route('login')->with('deactivated', 'This account has been deactivated');
            }
            auth()->login($user, true);
            return redirect('/home');
        }catch (\Exception $e){
            return redirect('login')->with('failed', "Failed to login using {$social}, please choose another method");
        }
    }

}
