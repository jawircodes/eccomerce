<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Admin dashboard
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
    Route::get('/',[\App\Http\Controllers\AdminController::class,'admin'])->name('admin');

    Route::group(['prefix'=>'banners'], function() {

        Route::get('/', [\App\Http\Controllers\BannerController::class, "index"])->name('banners.index');
        Route::get('/create', [\App\Http\Controllers\BannerController::class, "create"])->name('banners.create');
        Route::post('/store', [\App\Http\Controllers\BannerController::class, "store"])->name('banners.store');
        Route::get('get-banners', [\App\Http\Controllers\BannerController::class, "getBanners"])->name('banners.getBanners');

    });

    //banners section
   //Route::resource('banners','\App\Http\Controllers\BannerController');
   
});
