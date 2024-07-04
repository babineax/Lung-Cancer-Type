<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\uploadmanager;

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
Route::get('/', function () {
    return view('index1');
});

Route::get('/{pathvariable}', function ($pathvariable) {
    return view('index2', ['pathvariable' => $pathvariable]);
});
Route::get('/g', function () {
    return view('index1');
});
Route::post('/{pathvariable}/io', [uploadmanager::class,"upload"])->name("upload.post");