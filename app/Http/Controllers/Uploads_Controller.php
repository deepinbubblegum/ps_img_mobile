<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Uploads_Controller extends BaseController
{
    public function upload_files(Request $request)
    {
        try {
            // Uploads in storage/app/public folder and create directory name if not exists
            // create directory in storage/app/public
            $recv = $request->all();
            $id = $recv['id'];
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

            DB::table('uploads')->insert([
                'user_id' => $id,
                'path_dir' => $directory,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Files uploaded successfully'
        ]);
    }
}
