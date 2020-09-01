<?php

namespace App\Controllers\Dev;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class File extends Controller
{
    public function main(Request $request)
    {

    }

    public function files(Request $request)
    {
        return [
            'files' => Storage::disk('documents')->files(),
            'allFiles' => Storage::disk('documents')->allFiles(), // recursive
            'directories' => Storage::disk('documents')->directories(),
            'allDirectories' => Storage::disk('documents')->allDirectories(),
        ];
    }

    public function create(Request $request)
    {
        Storage::put('file1.txt', 'fiele_content'); // defaault local disk

        Storage::disk('documents')->put('file1.txt', 'fiele_content');

        // for access from server need command: php artisan storage:link
        Storage::disk('public')->put('public_file.txt', 'public_file_content');

        Storage::disk('documents')->put('file2.txt', 'fiele_content');

        $resource = Storage::disk('documents')->get('file2.txt');
        Storage::disk('documents')->put('file3.txt', $resource);

        $storagePath  = Storage::disk('documents')->getDriver()->getAdapter()->getPathPrefix();
        $generatedFile = Storage::putFile('documents', new \Illuminate\Http\File($storagePath.'/file2.txt')); // generated name

        Storage::putFileAs('documents', new \Illuminate\Http\File($storagePath.'/file2.txt'), 'custom_name.jpg');

        return [
            "generatedFile" => $generatedFile,
        ];
    }

    public function operations(Request $request)
    {
        Storage::disk('documents')->makeDirectory("subdir");

        Storage::disk('documents')->deleteDirectory("subdir"); //delete all file included

        Storage::disk('documents')->delete(['file4.txt', 'file5.txt', 'file6.txt']);

        Storage::disk('documents')->put('file4.txt', 'fiele_content');

        Storage::disk('documents')->prepend('file4.txt', 'Prepended Text');

        Storage::disk('documents')->append('file4.txt', 'Appended Text');

        Storage::disk('documents')->copy('file4.txt', 'file5.txt');

        Storage::disk('documents')->move('file5.txt', 'file6.txt');

        $contents = Storage::disk('documents')->get('file4.txt');

        return [
            'content' => $contents,
        ];
    }

    public function uploadFile(Request $request)
    {
        // header X-CSRF-TOKEN (token is bonded to session => generate token with /dev/token)

        $file = $request->file('file');

        if($file === null) {
            return [];
        }

        $filename = Storage::putFile('documents', $file);

        return [
            "fileinfo" => [
                'hashName' => $file->hashName(),
                'storage' => 'documents',
                'filename' => $filename,
                'originalFilename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'content' => Storage::disk('documents')->get($file->hashName()),
            ]
        ];
    }

    public function uploadFile2(Request $request)
    {

        $file = $request->file('file');
        $filename = $file->store('documents');

        return [
            "fileinfo" => [
                'filename' => $filename,
                'originalFilename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]
        ];
    }

    public function uploadFile3(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->storeAs('documents', "uploaded_file.txt");

        return [
            "fileinfo" => [
                'filename' => $filename,
                'originalFilename' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => $file->getRealPath(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]
        ];
    }

    public function missing(Request $request)
    {
        $missing = Storage::disk('documents')->missing('file.txt');
        $exists = Storage::disk('documents')->exists('file.txt');
        return [
            'exists'=>$exists,
            'misssing'=>$missing,
        ];
    }

    public function fileUrl(Request $request)
    {
        $url = Storage::url('file.txt');
        $asset = asset('storage/public_file.txt');

        return [
            'url'=>$url,
            'asset'=>$asset,
        ];
    }

    public function download(Request $request)
    {
        return Storage::download('file.txt');
    }

    public function downloadMime(Request $request)
    {
        Storage::disk('documents')->put('file.txt', 'Contents');

        $headers = [
            'Content-Type: text/plain',
        ];

        return Storage::download('file.txt', "test.txt", $headers);
    }

    public function uploadForm(Request $request)
    {
        Storage::disk('documents')->put('file.txt', 'Contents');

        $headers = [
            'Content-Type: text/plain',
        ];

        return view('dev/controllers.file/uploadForm');
    }

}
