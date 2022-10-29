<?php

namespace App\Helpers;

use DirectoryIterator;

class Icons
{
    // TODO: Implement searching for SVGs in the images folder.
    public static function get(string $name, string $class = null)
    {
        $icons = app('icons');
        if (isset($class)) {
            $icons->addCssClass($class);
        }
        return $icons->getIcon($name)->setAttribute('height', '')->setAttribute('width', '');
    }
}
