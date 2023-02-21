<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use stdClass;

use ZipArchive;
use Illuminate\Support\Facades\Response;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Support\Facades\Storage;

class View_img extends BaseController
{
    function main($user_id, $path_file)
    {
        // $path = Storage::disk(`public/$path_file`);
        $files = Storage::disk('public')->files($path_file);

        if (count($files) == 0) {
            abort(404);
        }

        $arr = array();
        foreach ($files as $file) {
            // $types[$file] = Storage::disk('public')->mimeType($file);
            $object = new stdClass;
            $object->file = $file;
            $object->type = Storage::disk('public')->mimeType($file);
            array_push($arr, $object);
        }
        return view('mobile', compact('arr', 'path_file'));
        // return view('mobile');
    }

    public function Download($folderName)
    {
        $path = storage_path('app/public/' . $folderName);
        $zipFile = $folderName . '.zip';
        $zipPath = storage_path('app/public/' . $zipFile);

        $zip = new ZipArchive;
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path),
            RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);

                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        return Response::download($zipPath, $zipFile)->deleteFileAfterSend(true);
    }
}
