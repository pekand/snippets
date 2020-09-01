<?php

namespace App\Controllers\Dev;

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

    // header X-CSRF-TOKEN (token is bonded to session => generate token with /dev/token)
    public function uploadFile(Request $request)
    {
        $file = $request->file('file');

        if($file === null){
            return [];
        }

        $filename = $file->store('documents');

        $contents = Storage::disk('documents')->get($file->hashName());

        return [
            "status"=>[
                "code"=>"1",
                "message" => "ok"
            ],
            "fileinfo" => [
                'filename' => $file->getClientOriginalName(),
                'hashName' => $file->hashName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ],
            "filename" => $filename,
            "content" => $contents,
        ];
    }

}
