<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class Users_Controller extends Controller
{
    private function GenerateID($length = 25)
    {
        $id = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 1, $length);
        return $id;
    }

    public function CreateUsers(Request $request)
    {
        try {
            $recv = $request->all();
            $ticket_point = $recv['ticket_point'];
            $user_id = $this->GenerateID();
            DB::table('users')->insert([
                'user_id' => $user_id,
                'ticket_point' => $ticket_point,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
        // get request url only domain 
        $url = $request->getSchemeAndHttpHost();
        $url_user = $url . '/' . $user_id;
        return response()->json([
            'status' => 'success',
            'message' => $url_user
        ]);
    }
}
