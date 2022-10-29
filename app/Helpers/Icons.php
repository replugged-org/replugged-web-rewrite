<?php

namespace App\Helpers;

class Icons
{
    public static function get(string $name)
    {
        return app('icons')->getIcon($name);
    }
}
