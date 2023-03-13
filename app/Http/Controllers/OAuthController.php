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

        // Are we logging in for the first time? If not, just update the
        // existing record.
        $user = User::updateOrCreate([
            'discord_id' => $discordUser->id,
        ], [
            'name' => $discordUser->name,
            'email' => $discordUser->email,
            'avatar' => $discordUser->avatar,
            // Don't ask me why the provider doesn't return the discriminator, even when it has access to it.
            // https://github.com/SocialiteProviders/Discord/blob/master/Provider.php#L89
            'discriminator' => explode("#", $discordUser->nickname)[1],
        ]);

        // Insert Discord into the user's accounts.
        $user->accounts()->updateOrCreate(
            ['account_name' => 'discord'],
            [
                'access_token' => $accessTokenResponseBody['access_token'],
                'refresh_token' => $accessTokenResponseBody['refresh_token'],
                'expires_at' => now()->timestamp + $accessTokenResponseBody['expires_in'],
                'token_type' => $accessTokenResponseBody['token_type'],
            ]
        );

        // We are authed!
        Auth::login($user);

        return redirect('/');
    }

    public function discordLogout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }

    public function patreonRedirect()
    {
        return Socialite::driver('patreon')->redirect();
    }
    public function patreonCallback()
    {
        $patreonUser = Socialite::driver('patreon')->user();
        $accessTokenResponseBody = $patreonUser->accessTokenResponseBody;

        $user = Auth::user();

        $user->accounts()->updateOrCreate(
            ['account_name' => 'patreon'],
            [
                'account_id' => $patreonUser->id,
                'name' => $patreonUser->email,
                'access_token' => $accessTokenResponseBody['access_token'],
                'refresh_token' => $accessTokenResponseBody['refresh_token'],
                'expires_at' => now()->timestamp + $accessTokenResponseBody['expires_in'],
                'token_type' => $accessTokenResponseBody['token_type'],
            ]
        );

        return redirect('/me');
    }
    public function patreonUnlink()
    {
        // @php-ignore
        Auth::user()->accounts()->where('account_name', 'patreon')->delete();

        return redirect('/me');
    }
}
