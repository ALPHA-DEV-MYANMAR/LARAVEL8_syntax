<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\HomeController;

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
    return view('welcome');
});

Route::get('test',function(){
    return dd('Middleware Test');
})->middleware('isAdmin');

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::resource('/category',CategoryController::class);
    Route::resource('/post',PostController::class);
    Route::resource('/photo',\App\Http\Controllers\PhotoController::class);
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('/tag',\App\Http\Controllers\TagsController::class);
});
