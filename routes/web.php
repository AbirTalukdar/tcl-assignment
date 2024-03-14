<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InvestmentController;

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
Route::get('/projects/list', [ProjectController::class, 'projectList'])->name('projects.list');
// // Investor registration routes


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/investor/register', [InvestorController::class, 'showRegistrationForm'])->name('investors.register');
    Route::post('/investor/register', [InvestorController::class, 'register']);

    //List Route
    Route::get('/user/list', [InvestorController::class, 'list'])->name('list');

    //Project Route
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    Route::get('/projects/{project}/investors', [ProjectController::class, 'investors'])->name('projects.investors');
    Route::get('projects/{projectId}/investors', [ProjectController::class, 'investors'])->name('projects.investors');
});

Route::middleware(['auth', 'role:investor'])->group(function () {
    Route::post('/investments', [InvestmentController::class, 'store'])->name('investments.store');
});


