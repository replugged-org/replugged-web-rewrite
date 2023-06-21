<?php

namespace App\Http\Controllers;

use App\Services\RPStoreService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class StoreController extends Controller
{
    public function showListing(RPStoreService $store, string $type)
    {
        $manifests = $store->listItems($type);
        $addons = $store->paginate($manifests, 10, null, ["path" => "/store/$type"]);
        return view('store', ['kind' => $type, 'addons' => $addons]);
    }

    public function getManifest(Request $request, RPStoreService $store, string $id): JsonResponse|array
    {
        $manifest = $store->getManifest($id);
        if ($manifest === null) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return response()->json($manifest);
    }

    public function getAsar(Request $request, RPStoreService $store, string $id): BinaryFileResponse|JsonResponse
    {
        $asarPath = $store->getAsar($id);
        if ($asarPath === null) {
            return response()->json(["error" => 404, "message" => "Not Found", "url" => "/{$request->path()}"]);
        }
        return response()->download($asarPath);
    }

    public function listItems(Request $request, RPStoreService $store, string $type): JsonResponse
    {
        $items = $request->get("items", 10);
        $query = $request->get("query", "");

        $manifests = $store->listItems($type, $query);
        $results = $store->paginate($manifests, $items, null, ["path" => "/{$request->path()}"]);

        return response()->json($results);
    }
}
