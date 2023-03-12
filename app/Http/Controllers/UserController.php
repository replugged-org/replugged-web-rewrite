<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me(Request $request)
    {
        $user = Auth::user();
        return view("me", ['user' => $user]);
    }

    public function profile(Request $request)
    {
        $discordID = $request->route('id');
        $user = User::where('discord_id', $discordID)->firstOrFail();

        return response()->json([
            'flags' => $user->flags & ~User::FLAG_GROUP_PRIVATE,
        ]);
    }
}
