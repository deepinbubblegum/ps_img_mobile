<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserGallery_Controller extends Controller
{
    public function UserGallery($user_id, Request $request)
    {
        // get path of user
        $user_id;
        // check if user exist
        $user = DB::table('users')
                ->where('user_id', $user_id)
                ->first();

        if ($user == null) {
            abort(404);
        }

        // get all folders of user
        $folders = DB::table('uploads')
                    ->where('user_id', $user_id)
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('UserGallery', compact('folders', 'user_id'));
    }
}
