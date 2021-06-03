<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAnnotationController;
use App\Http\Controllers\Admin\AdminDocumentController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProceedingController;

use App\Http\Controllers\ProceedingController;
use App\Http\Controllers\UserController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', [UserController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    //Route::get('/', [UserController::class, 'index'])->name('dashboard');
    Route::get('/proceedings', [ProceedingController::class, 'index'])->name('proceedings');

    Route::group(['prefix' => 'admin', 'middleware' => ['can:admin']], function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin');
        Route::get('users', [AdminUserController::class, 'index'])->name('users');
        Route::get('user/new', [AdminUserController::class, 'create'])->name('user.create');
        Route::post('user/new', [AdminUserController::class, 'store'])->name('user.store');

        Route::get('proceedings', [AdminProceedingController::class, 'index'])->name('proceedings');
        
        Route::get('{userId}/proceedings', [AdminProceedingController::class, 'userProceedings'])->name('user.proceedings');
        Route::get('{userId}/proceeding/new', [AdminProceedingController::class, 'create'])->name('proceeding.create');
        Route::post('{userId}/proceeding/add', [AdminProceedingController::class, 'store'])->name('proceeding.store');
        Route::get('{proceedingId}/show', [AdminProceedingController::class, 'show'])->name('proceeding.show');

        Route::get('{proceedingId}/document/upload', [AdminDocumentController::class, 'create'])->name('document.create');
        Route::post('{proceedingId}/document/upload', [AdminDocumentController::class, 'store'])->name('document.store');
        Route::get('{documentId}/show', [AdminDocumentController::class, 'show'])->name('document.show');

        Route::get('{proceedingId}/annotation/new', [AdminAnnotationController::class, 'create'])->name('annotation.create');
        Route::post('{proceedingId}/annotation/add', [AdminAnnotationController::class, 'store'])->name('annotation.store');

        Route::get('{proceedingId}/event/new', [AdminEventController::class, 'create'])->name('event.create');
        Route::post('{proceedingId}/event/add', [AdminEventController::class, 'store'])->name('event.store');
    });

});