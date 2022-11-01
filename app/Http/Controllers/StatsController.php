<?php

namespace App\Http\Controllers;

use App\Models\User;

class StatsController extends Controller
{
    public function index()
    {
        return view('contributors', ['contributors' => $this->contributors()]);
    }

    public function contributors()
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
