<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\View_img;

use App\Http\Controllers\Uploads_Controller;
use App\Http\Controllers\Users_Controller;
use App\Http\Controllers\UserGallery_Controller;
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

Route::get('/{user_id}', [UserGallery_Controller::class, 'UserGallery']);

Route::get('/view/{user_id}/{path}', [View_img::class, 'main']);

Route::get('Download/{path}', [View_img::class, 'Download']);

// route for uploads multiple files
Route::post('/uploads', [Uploads_Controller::class, 'upload_files']);

// route for create users
Route::post('/users/create', [Users_Controller::class, 'CreateUsers']);