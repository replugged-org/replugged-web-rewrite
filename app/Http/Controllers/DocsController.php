<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Parsedown;

class DocsController extends Controller
{
    public function index(Request $request)
    {
    }

    public function installation()
    {
        $txt = $this->getRemoteDocument("https://raw.githubusercontent.com/wiki/replugged-org/replugged/Installation.md");
        return view('markdown', ['content' => $txt]);
    }

    public function getRemoteDocument(string $url)
    {
        $Parsedown = new Parsedown();
        $res = Http::get($url);
        return $Parsedown->text($res->body());
    }
}
