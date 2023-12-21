<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
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

Route::get('/user', function (Request $request) {
    return $request->user();
});
// PRODUCT
Route::resource('products', ProductController::class);
Route::get('products/comments/{id}', [ProductController::class , 'getcomments'])->name('comment-product');

//CATE
Route::resource('/categories', CategoriesController::class);

//IMAGE
Route::post('/upload', [ImageController::class, 'upload'])->name('upload');
Route::post('/uploads', [ImageController::class, 'uploads'])->name('uploads');
Route::get('/images/{filename}', [ImageController::class, 'getImage'])->name('image.get');

//AUTH
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::get('/user-profile', [AuthController::class, 'userProfile']);
Route::post('/change-pass', [AuthController::class, 'changePassWord']);

//CART
Route::resource('carts', CartController::class);

//ORDER
Route::resource('/order', OrderController::class);
Route::put('/order/update-status/{id}' , [OrderController::class , 'updateStatus'])->name('update-status');

//COMMENT
Route::resource('comments', CommentController::class);
