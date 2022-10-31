<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        $discordID = $request->route('id');
        $user = User::where('discord_id', $discordID)->firstOrFail();

        return response()->json([
            'flags' => $user->flags & ~User::FLAG_GROUP_PRIVATE,
        ]);
    }
}
