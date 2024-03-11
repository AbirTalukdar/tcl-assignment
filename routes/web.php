<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestorController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Investor registration routes
// Route::get('/register', [InvestorController::class, 'showRegistrationForm'])->name('investors.register');
// Route::post('/register', [InvestorController::class, 'register']);

// // Investor login routes
// Route::get('/login', [InvestorController::class, 'showLoginForm'])->name('investors.login');
// Route::post('/login', [InvestorController::class, 'login']);
// Route::post('/logout', [InvestorController::class, 'logout'])->name('investors.logout')->middleware('auth:investor');
