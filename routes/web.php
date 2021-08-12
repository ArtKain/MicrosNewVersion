<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;



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

Route::redirect('/' , '/home');

Auth::routes();

Route::group(['middleware' => ['auth']] , function() {
    Route::redirect('/home', 'recording');
    Route::resource('recording' , RecordingController::class);
    Route::get('/category/create' , [CategoryController::class , 'create'])->name('category.create');
    Route::post('/category/create/store' , [CategoryController::class , 'store'])->name('category.store');
    Route::get('/search' , [SearchController::class , 'search'])->name('search');
});

