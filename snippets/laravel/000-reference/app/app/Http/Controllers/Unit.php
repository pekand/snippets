<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/**
 * Helper class for unittest examples
 *
 */
class Unit extends Controller
{
    public function getjson(Request $request)
    {
        return [
            "status"=>[
                "code"=>"1",
                "message" => "ok"
            ],
            "cookies" => Cookie::get(),
            "session" => Session::all(),
            "headers" => $request->headers->all(),
            "get" => $request->query(),
            "post" => $request->post(),
            "server" => $_SERVER,
        ];
    }

    public function getjsonblock(Request $request)
    {
        return [
            "status"=>[
                "code"=>"1",
                "message" => "ok"
            ]
        ];
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $file->store('documents');

        $contents = Storage::disk('documents')->get($file->getClientOriginalName());

        return [
            "status"=>[
                "code"=>"1",
                "message" => "ok"
            ],
            "fileinfo" => [
                'filename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]
        ];
    }

}
