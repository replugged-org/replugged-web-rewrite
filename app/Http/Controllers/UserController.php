<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private function getData()
    {
        $user = Auth::user();
        $patreon = $user
            ->accounts()
            ->where('account_name', 'patreon')
            ->get()
            ->first();
        return ['user' => $user, 'patreon' => $patreon];
    }
    public function me(Request $request)
    {
        return view("me", $this->getData());
    }
    public function editMe(Request $request)
    {
        return view("me.edit", $this->getData());
    }

    public function profile(Request $request)
    {
        $discordID = $request->route('id');
        $user = User::where('discord_id', $discordID)->firstOrFail();

        return response()->json([
            'flags' => $user->flags & ~User::FLAG_GROUP_PRIVATE,
        ]);
    }

    public function update_perks(Request $request)
    {
        $user = Auth::user();

        $user->patreon_data->badge = $request->get('badge_url');
        $user->patreon_data->badge_color = $request->get('badge_color');
        $user->patreon_data->badge_title = $request->get('badge_title') ?? 'default';
        $user->patreon_data->save();

        return redirect('/me');
    }
}
