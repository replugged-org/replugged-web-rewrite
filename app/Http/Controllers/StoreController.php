<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StoreController extends Controller
{
    public function getManifest(Request $request, string $id): JsonResponse|array
    {
        $manifestPath = storage_path("addons/manifests/$id.json");
        if (!File::exists($manifestPath)) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return File::json($manifestPath);
    }

    public function getAsar(Request $request, string $id): BinaryFileResponse|JsonResponse
    {
        $asarPath = storage_path("addons/asars/$id.asar");
        if (!File::exists($asarPath)) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return response()->download($asarPath);
    }

    public function listItems(Request $request, string $type): JsonResponse
    {
        $items = $request->get("items", 10);
        $query = $request->get("query", "");

        $manifestPath = storage_path("addons/manifests");
        $files = File::files($manifestPath);

        // Filter out the types we're not interested in listing
        $files = array_filter($files, function ($f) use ($type) {
            $manifest = (object) File::json($f);
            return $manifest->type === "replugged-$type";
        });

        // Turn the SplFileInfo[] into an array of manifests
        $manifests = array_map(fn ($f) => $f = (object) File::json($f), $files);

        if ($query != "") {
            $normalizedQuery = $this->normalize($query);

            usort($manifests, function($a, $b) use ($normalizedQuery) {
                $aNameMatch = Str::contains($this->normalize($a->name), $normalizedQuery);
                $bNameMatch = Str::contains($this->normalize($b->name), $normalizedQuery);
                if ($aNameMatch && !$bNameMatch) return -1;
                if (!$aNameMatch && $bNameMatch) return 1;

                $aNameStartsWith = Str::startsWith($this->normalize($a->name), $normalizedQuery);
                $bNameStartsWith = Str::startsWith($this->normalize($b->name), $normalizedQuery);
                if ($aNameStartsWith && !$bNameStartsWith) return -1;
                if (!$aNameStartsWith && $bNameStartsWith) return 1;

                $aDescMatch = Str::contains($this->normalize($a->description), $normalizedQuery);
                $bDescMatch = Str::contains($this->normalize($b->description), $normalizedQuery);
                if ($aDescMatch && !$bDescMatch) return -1;

                return 0;
            });
        }

        $results = $this->paginate($manifests, $items, null, ["path" => "/{$request->path()}"]);

        return response()->json($results);
    }

    private function normalize(string $str): string
    {
        $str = Str::lower($str);
        $str = trim($str);
        return preg_replace("/\\s+/", " ", $str);
    }

    private function paginate(Collection|array $items, $perPage = 10, $page = null, $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
