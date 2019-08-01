<?php

namespace App;

use Laravel\Socialite\Contracts\Provider;

class SocialAccountService
{

    public function setOrGetUser(Provider $provider) {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $account = SocialAccount::whereProvider($providerName)
            ->whereProviderId($providerUser->getId())
            ->first();

        if($account) {
            return $account->user;
        }

        $user = User::whereEmail($providerUser->getEmail())->first();

        if($user) {
            return $user;
        }

        $user = User::create([
            'email' => $providerUser->getEmail(),
            'name' => $providerUser->getName(),
            'user_type' => 'customer',
            'active' => 1
        ]);

        SocialAccount::create([
            'provider_id' => $providerUser->getId(),
            'provider' => $providerName,
            'user_id' => $user->id
        ]);
        return $user;

    }
}