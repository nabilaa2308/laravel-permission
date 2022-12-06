<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::group(['middleware' => ['auth']], function () {
    //dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    //Role
    Route::resource('/role', RoleController::class);
    //User
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::get('/user/{id}/detail', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/users', [UserController::class, 'update'])->name('users.update');
});
