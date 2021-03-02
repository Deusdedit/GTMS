<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;  
use App\Http\Controllers\ChangPasswordController; 
use App\Http\Controllers\PrintReportController; 
use App\Http\Controllers\DepartmentController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ActivityFinished;
use App\Http\Controllers\ActivityOngoing;
use App\Http\Controllers\AssignController;
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
Route::patch('cancelActivity/{id}',[App\Http\Controllers\ActivityController::class, 'cancel'])->name('cancelActivity');
Route::patch('startActivity/{id}',[App\Http\Controllers\ActivityController::class, 'start'])->name('startActivity');
Route::patch('activate/{id}',[App\Http\Controllers\UserController::class, 'activate'])->name('activate');
Route::patch('reset/{id}',[App\Http\Controllers\UserController::class, 'reset'])->name('reset');
Route::resource('activity', ActivityController::class);
Route::get('printReportActivity',[App\Http\Controllers\PrintReportController::class, 'activity'])->name('printReportActivity');
Route::resource('user', UserController::class);
Route::get('printReportActivityFinished',[App\Http\Controllers\PrintReportController::class, 'activityFinished'])->name('printReportActivityFinished');
Route::resource('department', DepartmentController::class);
Route::resource('section', SectionController::class);
Route::get('printReportActivityOngoing',[App\Http\Controllers\PrintReportController::class, 'activityOngoing'])->name('printReportActivityOngoing');
Route::get('individual',[App\Http\Controllers\ReportsController::class, 'index'])->name('individual');
Route::post('getIndividual',[App\Http\Controllers\ReportsController::class, 'individual'])->name('getIndividual');
Route::resource('finished', ActivityFinished::class);
Route::resource('ongoing', ActivityOngoing::class);
Route::resource('assign', AssignController::class);
