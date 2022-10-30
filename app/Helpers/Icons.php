<?php

namespace App\Helpers;

use DirectoryIterator;
use Feather\Exception\IconNotFoundException;
use Illuminate\Support\Facades\File;

class Icons
{
    public static function get(string $name, string $class = null)
    {
        try {
            $icons = app('icons');
            if (isset($class)) {
                $icons->addCssClass($class);
            }
            return $icons->getIcon($name)->setAttribute('height', '')->setAttribute('width', '');
        } catch (IconNotFoundException $e) {
            $dir = new DirectoryIterator(dirname(__FILE__) . "/../../resources/images");
            foreach ($dir as $file) {
                $filename = $file->getFilename();
                $filename = explode(".", $filename);
                if ($name == $filename[0]) {
                    $content = File::get($file->getRealPath());
                    $svg = preg_replace("/<svg (\w+='.*')/", "<svg $1 class='{$class}'", $content);
                    return $svg;
                }
            }
        }
    }
}
