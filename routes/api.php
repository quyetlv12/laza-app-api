<?php

use App\Http\Controllers\FavourateController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('products', ProductController::class);

Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
Route::post('/uploads', [ImageController::class, 'uploads'])->name('uploads');

Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('image.get');