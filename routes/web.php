<?php

use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/get-user', [Controller::class,'getUser'])->name('get.user');
Route::get('/get-status', [Controller::class,'getStatus'])->name('get.status');
Route::get('/get-priority', [Controller::class,'getPriority'])->name('get.prority');
Route::get('/get-subject', [Controller::class,'getSubject'])->name('get.subject');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middlewere' => ['auth']],function () {

    Route::resource('user',UserController::class);
    Route::post('user-list', [UserController::class,'dataList'])->name('user.list');

    Route::resource('ticket',TicketController::class);
    Route::post('ticket-list', [TicketController::class,'dataList'])->name('ticket.list');
});