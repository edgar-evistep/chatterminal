<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\SlackBotController;
use Illuminate\Support\Facades\Http;
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

// Routes

/*
|--------------------------------------------------------------------------
| Sign Up Route
|--------------------------------------------------------------------------
|
|
*/
Route::get('/', [SignUpController::class, 'create'])->name('sign_up');
Route::post('/register', [SignUpController::class, 'store'])->name('register');

/*
|--------------------------------------------------------------------------
| Sign In Route
|--------------------------------------------------------------------------
|
|
*/
Route::get('/sign_in', [SignInController::class, 'create'])->name('sign_in');
Route::post('/login', [SignInController::class, 'check'])->name('login');


/*
|--------------------------------------------------------------------------
| Chat Route
|--------------------------------------------------------------------------
|
|
*/
Route::get('/chat', [ChatController::class, 'create'])->name('chat')->middleware('checkLogin');
Route::post('/new_message', [ChatController::class, 'store'])->name('new_message');
Route::post('/email', [SlackBotController::class, 'email'])->name('slack_bot_email');
//Route::get('/email', [SlackBotController::class, 'check'])->name('slack_bot_check');


