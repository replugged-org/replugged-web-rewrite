<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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
        $manifests = array_map(fn ($f) => $f = (object) File::json($f), $files);

        $results = $this->paginate($manifests, $items, null, ["path" => "/{$request->path()}"]);

        return response()->json($results);
    }

    private function paginate(Collection|array $items, $perPage = 10, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
