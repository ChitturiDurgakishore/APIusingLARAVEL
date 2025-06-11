<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/Register', [ApiController::class, 'Register']);
Route::post('/Login', [ApiController::class, 'Login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/getapi', [ApiController::class, 'getapi']);
    Route::post('/postapi', [ApiController::class, 'postapi']);
    Route::put('/putapi', [ApiController::class, 'putapi']);
    Route::delete('/deleteapi', [ApiController::class, 'deleteapi']);
});
