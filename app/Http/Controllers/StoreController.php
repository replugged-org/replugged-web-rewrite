<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function getManifest(Request $request, string $id)
    {
        $manifestPath = storage_path("addons/manifests/$id.json");
        if (!File::exists($manifestPath)) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return File::json($manifestPath);
    }

    public function getAsar(Request $request, string $id)
    {
        $asarPath = storage_path("addons/asars/$id.asar");
        if (!File::exists($asarPath)) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return response()->download($asarPath);
    }

    public function listItems(Request $request, string $type)
    {
        $manifestPath = storage_path("addons/manifests");
        $files = File::files($manifestPath);

        // Filter out the types we're not interested in listing
        $files = array_filter($files, function ($f) use ($type) {
            $manifest = (object) File::json($f);
            return $manifest->type === "replugged-$type";
        });

        // Turn the SplFileInfo[] into an array of manifests
        $manifests = array_map(fn ($f) => $f = File::json($f), $files);

        return response()->json($manifests);
    }
}
