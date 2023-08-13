<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    GenreController,
    LoginController,
    BookController,
    AuthorController,
    HomeController
};

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

Route::post("login",LoginController::class);

// Genres (Http\GenreController)
// start
Route::apiResource("genres",GenreController::class)->middleware("auth:sanctum");
// end

// Books (Http\BookController)
// start
Route::apiResource("books",BookController::class)->middleware("auth:sanctum");
// end

// Books (Http\BookController)
// start
Route::apiResource("authors",AuthorController::class)->middleware("auth:sanctum");
// end

// Statistics (Http\HomeController)
// start
Route::get("statistics",[HomeController::class,"statistics"]);
// end

Route::get("hash",function(){
    return \Illuminate\Support\Facades\Hash::make("12345678");
});
