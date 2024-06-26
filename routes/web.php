<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AssignController;
use App\Http\Controllers\CashController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ErrorController;

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
    return redirect('/login');;
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/projects/list', [ProjectController::class, 'projectList'])->name('projects.list');
// Investor registration routes


Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Project Route
    Route::group(['prefix' => 'project', 'as' => 'project.'], function () {
        Route::get('/show', [ProjectController::class, 'show'])->name('show');
        Route::post('/list', [ProjectController::class, 'list'])->name('list');
        Route::get('create', [ProjectController::class, 'create'])->name('create');
        Route::post('store', [ProjectController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ProjectController::class, 'update'])->name('update');
        Route::post('delete', [ProjectController::class, 'delete'])->name('delete');
    });

    // Client Route
    Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
        Route::get('/show', [ClientController::class, 'show'])->name('show');
        Route::post('/list', [ClientController::class, 'list'])->name('list');
        Route::get('create', [ClientController::class, 'create'])->name('create');
        Route::post('store', [ClientController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ClientController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [ClientController::class, 'update'])->name('update');
        Route::post('delete', [ClientController::class, 'delete'])->name('delete');
    });

    // Assign Project to Client
    Route::group(['prefix' => 'assign', 'as' => 'assign.'], function () {
        Route::get('/show', [AssignController::class, 'show'])->name('show');
        Route::post('/list', [AssignController::class, 'list'])->name('list');
        Route::get('create', [AssignController::class, 'create'])->name('create');
        Route::post('store', [AssignController::class, 'store'])->name('store');
        Route::get('edit/{id}', [AssignController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AssignController::class, 'update'])->name('update');
        Route::post('delete', [AssignController::class, 'delete'])->name('delete');
    });

    // Cash
    Route::group(['prefix' => 'cash', 'as' => 'cash.'], function () {
        Route::get('/show', [CashController::class, 'show'])->name('show');
        Route::post('/list', [CashController::class, 'list'])->name('list');
        Route::get('create', [CashController::class, 'create'])->name('create');
        Route::post('store', [CashController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CashController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [CashController::class, 'update'])->name('update');
        Route::post('delete', [CashController::class, 'delete'])->name('delete');
    });

    Route::get('/projects/by-client', [ProjectController::class, 'getProjectsByClient'])->name('projects.by_client');

    Route::get('/investor/register', [ClientController::class, 'showRegistrationForm'])->name('investors.register');
    Route::post('/investor/register', [ClientController::class, 'register']);

    //List Route
    Route::get('/user/list', [ClientController::class, 'list'])->name('list');

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


Route::fallback([ErrorController::class, 'handle400Error']);

Route::fallback([ErrorController::class, 'handle500Error']);
