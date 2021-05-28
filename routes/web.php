<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProceedingController;
use App\Http\Controllers\ProceedingController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/proceedings', [ProceedingController::class, 'index'])->name('proceedings');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminHomeController::class, 'index'])->name('index');
    Route::get('users', [AdminUserController::class, 'index'])->name('users');
    Route::get('user/new', [AdminUserController::class, 'create'])->name('user.create');
    Route::post('user/new', [AdminUserController::class, 'store'])->name('user.store');

    Route::get('proceedings', [AdminProceedingController::class, 'index'])->name('proceedings');
    
    Route::get('{userId}/proceedings', [AdminProceedingController::class, 'userProceedings'])->name('user.proceedings');
    Route::get('{userId}/proceeding/new', [AdminProceedingController::class, 'create'])->name('proceeding.create');
    Route::post('{userId}/proceeding/add', [AdminProceedingController::class, 'store'])->name('proceeding.store');
});