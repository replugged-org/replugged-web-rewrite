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
}
