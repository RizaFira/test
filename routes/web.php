<?php

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
    return view('home');
});

Route::get('/chat-template/{key}',[App\Http\Controllers\WidgetController::class, 'chat'])->name('chat');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('home');

Route::post('/testAi', [App\Http\Controllers\HomeController::class, 'testAi'])->name('hook');
Route::post('/hook', [App\Http\Controllers\HomeController::class, 'hook'])->name('hook');
Route::post('/hook2', [App\Http\Controllers\HomeController::class, 'hook2'])->name('hook2');
Route::post('/klinik', [App\Http\Controllers\HomeController::class, 'klinik'])->name('klinik');
