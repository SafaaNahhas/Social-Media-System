<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('posts',[PostController::class,'index']);
    Route::get('post/{id}',[PostController::class,'show']);
    Route::post('posts',[PostController::class,'store']);
    Route::put('post/{id}',[PostController::class,'update']);
    Route::delete('posts/{id}',[PostController::class,'destroy']);

    Route::apiResource('category',CategoryController::class);


    Route::post('comments/{post_id}',[CommentController::class,'create']);
    Route::get('comments/{post_id}',[CommentController::class,'list']);
    Route::put('comments/{comment_id}',[CommentController::class,'update']);
    Route::delete('comments/{comment_id}',[CommentController::class,'delete']);


});




Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);
Route::get('profile', [AuthController::class,'userProfile']);
