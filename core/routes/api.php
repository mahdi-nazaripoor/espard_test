<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\UserBookmarkProductController;
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


Route::group(['prefix' => 'v1','namespace' => 'API/V1'], function () {
    //Routes for guest user
    Route::get('products',[ProductController::class,'index'])->name('products.index');

    Route::post('auth/login',[AuthController::class,'login'])->name('auth.login');

    Route::group(['middleware' => 'auth:api'], function () {

        Route::post('auth/logout',[AuthController::class,'logout'])->name('auth.logout');
        Route::post('auth/refresh',[AuthController::class,'refresh'])->name('auth.refresh');


        //Routes for registered user
        Route::get('products/{product}',[ProductController::class,'show'])->name('products.show');

        Route::get('user_bookmark_product',[UserBookmarkProductController::class,'index'])->name('user.bookmarked_products');
        Route::post('user_bookmark_product',[UserBookmarkProductController::class,'store'])->name('products.bookmark');
        Route::delete('user_bookmark_product',[UserBookmarkProductController::class,'destroy'])->name('products.unbookmark');


        //Routes only for Admin user
        Route::group(['middleware' => 'Admin'], function () {
            Route::get('products/create',[ProductController::class,'create'])->name('products.create');
            Route::post('products',[ProductController::class,'store'])->name('products.store');
            Route::patch('products/{product}',[ProductController::class,'update'])->name('products.update');
            Route::delete('products/{product}',[ProductController::class,'destroy'])->name('products.destroy');
        });


    });

});
