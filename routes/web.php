<?php

use App\BlogApi\Facades\BlogApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'index']);

Auth::routes();

Route::controller('PostController')->name('blog.')
    ->group(function () {
        Route::get('/blog', 'index')->name('index');
        Route::get('/{slug?}', 'show')->name('show');
        Route::get('/', 'index')->name('home');
    });



Route::prefix('dashboard')->name('dashboard.')
    ->middleware('auth')->controller('Dashboard\PostController')->group(function () {
        Route::get('home', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
    });



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
