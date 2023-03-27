<?php

use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//********  routes publiques ****** */
Route::post('/register', [AuthCtrl::class, 'register']);
Route::post('/login', [AuthCtrl::class, 'login']);
Route::get('/books',[BookController::class,'index']);
Route::get('/books/search/{name}',[BookController::class,'search']);
Route::get('/books/searchid/{id}',[BookController::class,'show']);

//********  routes protégées ****** */

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/books',[BookController::class,'store']);
    Route::post('/books/{id}',[BookController::class,'update']);
    Route::delete('/books/{id}',[BookController::class,'destroy']);
    Route::post('/logout', [AuthCtrl::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
