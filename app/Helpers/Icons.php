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
            // Base directory to search in
            $basedir = dirname(__FILE__) . "/../../resources/images";
            if (str_contains($name, ".")) {
                // Nesting was detected, add whatever nesting segments to the base directory
                $basedir .= "/" . str_replace(".", "/", $name);
                $seg = explode("/", $basedir);
                array_pop($seg);
                $basedir = implode("/", $seg);

                // Set the new filename to the last `.` split part of the name
                $namesplit = explode(".", $name);
                $name = end($namesplit);
            }

            $dir = new DirectoryIterator($basedir);
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
