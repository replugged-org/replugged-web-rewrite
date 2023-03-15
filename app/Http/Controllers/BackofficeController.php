<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BackofficeController extends Controller
{
    public function showUsers()
    {
        $user = Auth::user();
        if (!($user->flags & User::FLAG_STAFF)) {
            // You see, the page doesn't even exist! :lenya:
            return abort(404);
        }

        $users = User::all();
        return view('backoffice.users', ['users' => $users]);
    }
}
