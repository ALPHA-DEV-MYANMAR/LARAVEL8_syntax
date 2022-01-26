<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Models\Post;
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
    $posts = Post::when(isset(request()->search),function ($query){
        $search = request()->search;
        $query->where('title',"LIKE","%$search%")
            ->orWhere('description',"LIKE","%$search%");
    })->latest('id')->paginate(5);
    return view('post.index',compact('posts'));
})->name('welcome');

Route::get('test',function(){
    return 'Hello world';
})->middleware('isAdmin');

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::resource('category',CategoryController::class);
    Route::resource('post',PostController::class);
    Route::resource('photo',PhotoController::class);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::resource('tag',TagsController::class);
    Route::resource('user',UserController::class );
});

Route::middleware('isAdmin')->group(function(){
    Route::resource('category',CategoryController::class);
    Route::resource('tag',TagsController::class);
    Route::resource('user',UserController::class );
});
