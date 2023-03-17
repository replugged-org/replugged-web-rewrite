<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function editUser(Request $request, int $id){
        $user = User::where('discord_id', $id)->get();
        if ($user->isEmpty()) {
            abort(404);
        }
        $user = $user->first();

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
