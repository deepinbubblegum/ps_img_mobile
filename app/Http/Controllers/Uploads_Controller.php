<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Uploads_Controller extends BaseController
{
    public function upload_files(Request $request)
    {
        try {

            // Uploads in storage/app/public folder and create directory name if not exists
            // create directory in storage/app/public
            $recv = $request->all();
            $directory = $recv['directory'];
            $path = storage_path('app/public/' . $directory);
            // dd($path);
            // check if directory exists
            if (!File::isDirectory($path)) {
                // create directory
                File::makeDirectory($path, 0777, true, true);
            }

            // upload files
            $files = $request->file('files');
            $files = is_array($files) ? $files : [$files];
            foreach ($files as $file) {
                $file->storeAs('public/' . $directory, $file->getClientOriginalName());                
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'Files not uploaded',
                'message' => $th->getMessage()
            ]);
        }
        return response()->json([
            'status' => 'Files uploaded successfully',
            'message' => 'Files uploaded successfully'
        ]);
    }
}
