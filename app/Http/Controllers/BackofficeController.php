<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackofficeController extends Controller
{
    public function showUsers()
    {
        $user = Auth::user();
        if (!($user->flags & User::FLAG_STAFF)) {
            // You see, the page doesn't even exist! :lenya:
            abort(404);
        }

        $users = User::all();
        return view('backoffice.users', ['users' => $users]);
    }

    public function showEditUsers(int $id)
    {
        $user = User::where('discord_id', $id)->get();
        if ($user->isEmpty()) {
            abort(404);
        }
        $user = $user->first();

        return view('backoffice.edit-user', ['user' => $user]);
    }

    public function editUser(Request $request, int $id)
    {
        $user = User::where('discord_id', $id)->get();
        if ($user->isEmpty()) {
            abort(404);
        }
        $user = $user->first();

        // Thank you, Dima
        // <https://discord.com/channels/382339402338402315/382339402338402317/1128675442031865976>
        $flags = [
            'badgeDeveloper' => User::FLAG_DEVELOPER,
            'badgeStaff' => User::FLAG_STAFF,
            'badgeSupport' => User::FLAG_SUPPORT,
            'badgeContributor' => User::FLAG_CONTRIBUTOR,
            'badgeHunter' => User::FLAG_BUG_HUNTER,
            'badgeEarly' => User::FLAG_EARLY_USER,
            'badgeTranslator' => User::FLAG_TRANSLATOR,
        ];
        foreach ($flags as $name => $bit) {
            $user->flags = $request->get($name) == 'on' ? ($user->flags | $bit) : ($user->flags & ~$bit);
        }
        $user->save();

        $user->patreon_data->badge = $request->get('badge_url');
        $user->patreon_data->badge_color = $request->get('badge_color');
        $user->patreon_data->badge_title = $request->get('badge_title') ?? 'default';
        $user->patreon_data->guild_badge_id = $request->get('guild_id');
        $user->patreon_data->guild_badge = $request->get('guild_badge_url');
        $user->patreon_data->guild_badge_title = $request->get('guild_tooltip');
        $user->patreon_data->save();

        return redirect(route('backoffice.users'));
    }
}
