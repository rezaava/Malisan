<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function (Request $request) {
    return 'a';
});

Route::get('/test', 
[TestController::class,'test']
);

Route::middleware('auth:api')->get('/test2', 
[TestController::class,'test2']
);
