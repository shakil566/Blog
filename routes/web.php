<?php

use App\Http\Controllers\Frontend\BlogCommentController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[FrontendController::class,'index']);
Route::get('/blog-comment/{id}/{slug}',[FrontendController::class,'blogdetails']);
Route::post('/blog-comment',[FrontendController::class,'blogComment']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function () {

    Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog');
    Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('blog.store');
    Route::post('/blog/filter', [App\Http\Controllers\Admin\BlogController::class, 'filter']);
    Route::get('/blog/{id}/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('blog.destroy');


});
