<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function discordRedirect(Request $request)
    {
        return Socialite::driver('discord')->redirect();
    }

    public function discordCallback(Request $request)
    {
        $discordUser = Socialite::driver('discord')->user();
        $accessTokenResponseBody = $discordUser->accessTokenResponseBody;

        $user = User::updateOrCreate([
            'discord_id' => $discordUser->id,
        ], [
            'name' => $discordUser->name,
            'email' => $discordUser->email,
            'avatar' => $discordUser->avatar,
            // Don't ask me why the provider doesn't return the discriminator, even when it has access to it.
            // https://github.com/SocialiteProviders/Discord/blob/master/Provider.php#L89
            'discriminator' => explode("#", $discordUser->nickname)[1],
            'discord_token' => $accessTokenResponseBody['access_token'],
            'discord_refresh_token' => $accessTokenResponseBody['refresh_token'],
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function discordLogout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
