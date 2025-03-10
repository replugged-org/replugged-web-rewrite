<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use stdClass;

// TODO: Separation of concerns
class OAuthController extends Controller
{
    private const DONATION_TIERS = [100, 500, 1000, INF];
    private const GRACE_PERIOD = 5 * 24 * 3600e3;

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

        $pledgeData = $this->patreonPledgeStatus($accessTokenResponseBody['token_type'], $accessTokenResponseBody['access_token']);
        $user->patreon_data()->updateOrCreate([], [
            'pledge_tier' => $pledgeData->status->pledgeTier,
            'perks_expire_at' => $pledgeData->status->perksExpireAt,
        ]);

        return redirect('/me');
    }
    public function patreonUnlink()
    {
        Auth::user()->accounts()->where('account_name', 'patreon')->delete();

        return redirect('/me');
    }

    private function patreonPledgeStatus(string $type, string $token): stdClass
    {
        $res = Http::withHeaders([
            'Authorization' => "{$type} {$token}",
        ])->get('https://patreon.com/api/oauth2/v2/identity', [
            'include' => 'memberships',
            'fields[member]' => 'patron_status,currently_entitled_amount_cents,next_charge_date'
        ])->json();
        $res = json_decode(json_encode($res));

        $donated = false;
        $data = (object) ['pledgeTier' => 0, 'perksExpireAt' => -1];
        // Love the absence of ?. in PHP.
        $pledgeData = isset($res->included)
            ? (isset($res->included[0])
                ? $res->included[0]->attributes
                : null)
            : null;
        if (!isset($pledgeData)) {
            return (object) ['donated' => $donated, 'status' => $data];
        }

        if (isset($pledgeData->patreon_status)) {
            $donated = true;
        }

        if ($pledgeData->patron_status !== 'active_patron') {
            return (object) ['donated' => $donated, 'status' => $data];
        }

        // Equivalent of `DONATION_TIERS.findIndex(v => v > spent);` in JS.
        // Forgive me, Niels.
        $data->pledgeTier = array_search(current(array_filter($this::DONATION_TIERS, fn ($v) => $v > $pledgeData->currently_entitled_amount_cents)), $this::DONATION_TIERS);
        $data->perksExpireAt = (int) date('U', strtotime('2018-04-01T20:09:18+00:00')) + $this::GRACE_PERIOD;

        return (object) ['donated' => $donated, 'status' => $data];
    }
}
