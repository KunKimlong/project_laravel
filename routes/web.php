<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LogoController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/register',[UserController::class,'openregister']);
Route::post('/register',[UserController::class,'register']);
Route::get('/login',[UserController::class,'openlogin'])->name('login');
Route::post('/login',[UserController::class,'login']);


Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function() {
        Route::get('/',[DashboardController::class,'index']);

        // logo

        Route::get('/add-logo',[LogoController::class,'openAdd']);
        Route::post('/add-logo',[LogoController::class,'addLogo']);
        Route::get('/list-logo',[LogoController::class,'viewLogo']);
        Route::get('/update-logo/{id}',[LogoController::class,'openUpdate']);
        Route::post('/update-logo',[LogoController::class,'UpdateLogo']);
        Route::post('/delete-logo',[LogoController::class,'DeleteLogo']);

        // category
        Route::get('/add-category',[CategoryController::class,'openAdd']);
        Route::post('/add-category',[CategoryController::class,'addCategory']);
        Route::get('/list-category',[CategoryController::class,'VeiwCategory']);
        Route::get('/update-category/{id}',[CategoryController::class,'openUpdate']);
        Route::post('/update-category',[CategoryController::class,'UpdateCategory']);
        Route::post('/delete-category',[CategoryController::class,'DeleteCategory']);

        // product

        Route::get('/list-product',[ProductController::class,'viewProduct']);
        Route::get('/add-product',[ProductController::class,'openAdd']);
        Route::post('/add-product',[ProductController::class,'addProduct']);
        Route::get('/update-product/{id}',[ProductController::class,'openUpdate']);
        Route::post('/update-product',[ProductController::class,'updateProduct']);
        Route::post('/delete-product',[ProductController::class,'deleteProduct']);

    });
});