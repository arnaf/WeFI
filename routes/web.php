<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;

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

require_once('includes/auth.php');



Route::get('/', function () {
    return view('/components/auth/login');
})->name('loginform');

Route::get('/register', function () {
    return view('components.auth.register');
})->name('registerform');

Route::post('/register', [RegisterController::class, 'register'])->name('register');


