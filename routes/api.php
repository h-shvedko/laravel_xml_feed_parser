<?php

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
Route::prefix('v1')->group(function () {
    Route::get('/xmlToJson',[App\Http\Controllers\Api\v1\ParserController::class,'parseXml'])->name('api.parsexml');
});

Route::prefix('v2')->name('v2.')->group(function () {
    Route::get('/xmlToJson',[App\Http\Controllers\Api\v2\ParserController::class,'parseXml'])->name('api.parsexml');
});

