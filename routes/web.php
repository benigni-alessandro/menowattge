<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmailController;
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
    return view('auth.register');
});



Auth::routes();



Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RolController::class);
    Route::resource('users', UserController::class);
    Route::resource('posts', PostController::class);
    Route::get('mail', [EmailController::class, 'mailView'])->name('mailView');
    Route::post('send-mail', [EmailController::class, 'mailSend'])->name('mailSend');
    
    
});
