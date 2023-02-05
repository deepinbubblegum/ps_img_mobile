<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\View_img;

use App\Http\Controllers\Uploads_Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/{id}', function () {
//     return view('mobile');
// });

Route::get('/{path}', [View_img::class, 'main']);

Route::get('Download/{path}', [View_img::class, 'Download']);

// route for uploads multiple files
Route::post('/uploads', [Uploads_Controller::class, 'upload_files']);
