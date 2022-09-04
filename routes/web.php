<?php

use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FactorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

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

Route::fallback(function () {
    return view('errors.404');
});

Route::get('/artisan', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
});

Route::get('/login', [LoginController::class, 'login_show']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/reset', [LoginController::class, 'reset']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('factor/pdf/{id}', [FactorController::class, 'pdf']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile', [UserController::class, 'profile_update']);

    Route::prefix('/user')->group(function () {
        Route::get('/list/{access}', [UserController::class, 'index']);
        Route::get('/show/{access}/{id?}', [UserController::class, 'add']);
        Route::post('/add', [UserController::class, 'store']);
        Route::post('/edit', [UserController::class, 'update']);
        Route::delete('/remove/{id}', [UserController::class, 'remove']);
    });

    Route::prefix('/product')->group(function () {
        Route::get('/list', [ProductController::class, 'index']);
        Route::get('/show/{id?}', [ProductController::class, 'add']);
        Route::post('/add', [ProductController::class, 'store']);
        Route::post('/edit', [ProductController::class, 'update']);
        Route::delete('/remove/{id}', [ProductController::class, 'remove']);
    });

    Route::prefix('/factor')->group(function () {

        Route::get('/list', [FactorController::class, 'index']);
        Route::get('/show/{id?}', [FactorController::class, 'add']);
        Route::get('/invoice/{id}', [FactorController::class, 'invoice']);
        Route::post('/add', [FactorController::class, 'store']);
        Route::post('/edit', [FactorController::class, 'update']);
        Route::delete('/remove/{id}', [FactorController::class, 'remove']);

        Route::get('/status/{status}', [FactorController::class, 'detail_status_list']);

        Route::get('/detail/list', [FactorController::class, 'list_detail']);
        Route::delete('/detail/remove/{id}', [FactorController::class, 'remove_detail']);
        Route::post('/detail/add', [FactorController::class, 'store_detail']);
        Route::post('/detail/producer', [FactorController::class, 'store_producer']);

        Route::prefix('/message')->group(function () {
            Route::get('/{factor}', [MessageController::class, 'list']);
            Route::get('/{factor}/{detail}', [MessageController::class, 'list']);
            Route::post('/text', [MessageController::class, 'text']);
            Route::post('/file', [MessageController::class, 'file']);
        });

    });

    Route::prefix('/message')->group(function () {
        Route::get('/{user}', [MessageController::class, 'user']);
    });

    Route::prefix('/ajax')->group(function () {
        Route::post('/producer/get', [ProductController::class, 'get_producer']);
    });

});
