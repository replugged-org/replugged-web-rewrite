<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function contrubutors(Request $request)
    {
        $res = [
            'developers' => [],
            'staff' => [],
            'contributors' => [],
        ];

        foreach (User::all() as $user) {
            if ($user->flags & User::FLAG_DEVELOPER) {
                array_push($res["developers"], $user);
            } else if (($user->flags & User::FLAG_STAFF) || ($user->flags & User::FLAG_SUPPORT)) {
                array_push($res["staff"], $user);
            } else if ($user->flags & User::FLAG_CONTRIBUTOR) {
                array_push($res["contributors"], $user);
            }
        }

        return $res;
    }
}
