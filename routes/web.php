<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;  
use App\Http\Controllers\ChangPasswordController; 
use App\Http\Controllers\PrintReportController; 
use App\Http\Controllers\UserController;
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
Route::get('change-password', [App\Http\Controllers\ChangPasswordController::class, 'index'])->name('change');
Route::post('change-password', [App\Http\Controllers\ChangPasswordController::class, 'changePassword']);
Route::get('finishActivity',[App\Http\Controllers\ActivityController::class, 'finish'])->name('finishActivity');
Route::patch('finishActivity/{id}',[App\Http\Controllers\ActivityController::class, 'finish'])->name('finishActivity');
Route::patch('activate/{id}',[App\Http\Controllers\UserController::class, 'activate'])->name('activate');
Route::patch('reset/{id}',[App\Http\Controllers\UserController::class, 'reset'])->name('reset');
Route::resource('activity', ActivityController::class);
Route::get('printReportActivity',[App\Http\Controllers\PrintReportController::class, 'activity'])->name('printReportActivity');
Route::resource('user', UserController::class);