<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;  
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
    // return view('welcome');
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('finishActivity',[App\Http\Controllers\ActivityController::class, 'finish'])->name('finishActivity');
Route::resource('activity', ActivityController::class);