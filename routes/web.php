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

Route::get('user/{userId}/verify', [UserController::class, 'verifyUser'])->name('verify-user');
Route::post('user/{userId}/verify', [UserController::class, 'updateVerifiedUser'])->name('update-user');

Route::middleware(['auth:sanctum', 'verified'])->get('/', [UserController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/proceedings', [ProceedingController::class, 'index'])->name('proceedings');
    
    Route::group(['prefix' => 'proceeding'], function () {
        
    
        Route::group(['middleware' => ['can:admin']], function () {
            Route::get('{proceedingId}/edit', [AdminProceedingController::class, 'edit'])->name('proceeding.edit');
            Route::put('{proceedingId}', [AdminProceedingController::class, 'update'])->name('proceeding.update');
            Route::get('{proceedingId}/users', [AdminProceedingController::class, 'listUsersForProceeding'])->name('proceeding.users.show');
            Route::post('{proceedingId}/users', [AdminProceedingController::class, 'addUserToProceeding'])->name('proceeding.users.add');
            Route::delete('{proceedingId}/users', [AdminProceedingController::class, 'deleteUserFromProceeding'])->name('proceeding.users.delete');
            Route::get('{proceedingId}/delete', [AdminProceedingController::class, 'delete'])->name('proceeding.delete');
            Route::delete('{proceedingId}/delete', [AdminProceedingController::class, 'destroy'])->name('proceeding.destroy');
        });

        Route::get('{proceedingId}', [AdminProceedingController::class, 'show'])->name('proceeding.show');

        Route::get('{proceedingId}/document/upload', [AdminDocumentController::class, 'create'])->name('document.create');
        Route::post('{proceedingId}/document/upload', [AdminDocumentController::class, 'store'])->name('document.store');
        Route::get('document/{documentId}/download', [AdminDocumentController::class, 'show'])->name('document.show');
        Route::put('document/{documentId}/update', [AdminDocumentController::class, 'update'])->name('document.update');
        Route::delete('document/{documentId}/delete', [AdminDocumentController::class, 'destroy'])->name('document.delete');

        Route::get('{proceedingId}/annotation/add', [AdminAnnotationController::class, 'create'])->name('annotation.create');
        Route::post('{proceedingId}/annotation/add', [AdminAnnotationController::class, 'store'])->name('annotation.store');
        Route::get('annotation/{annotationId}/edit', [AdminAnnotationController::class, 'edit'])->name('annotation.edit');
        Route::put('annotation/{annotationId}/update', [AdminAnnotationController::class, 'update'])->name('annotation.update');
        Route::delete('annotation/{annotationId}/delete', [AdminAnnotationController::class, 'destroy'])->name('annotation.delete');

        Route::get('{proceedingId}/event/add', [AdminEventController::class, 'create'])->middleware('can:event.add')->name('event.create');
        Route::post('{proceedingId}/event/add', [AdminEventController::class, 'store'])->middleware('can:event.add')->name('event.store');
        Route::get('event/{eventId}/edit', [AdminEventController::class, 'edit'])->middleware('can:event.edit')->name('event.edit');
        Route::put('event/{eventId}/update', [AdminEventController::class, 'update'])->middleware('can:event.edit')->name('event.update');
        Route::delete('event/{eventId}/delete', [AdminEventController::class, 'destroy'])->middleware('can:event.destroy')->name('event.delete');

        Route::post('{proceedingId}/status', [AdminProceedingController::class, 'updateStatus'])->middleware('can:status.edit')->name('status.update');
    });

    Route::group(['prefix' => 'admin', 'middleware' => ['can:admin']], function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin');
        Route::get('users', [AdminUserController::class, 'index'])->name('admin.users');
        Route::get('/proceedings', [AdminProceedingController::class, 'index'])->name('admin.proceedings');

        Route::group(['prefix' => 'user'], function () {
            Route::get('add', [AdminUserController::class, 'create'])->name('user.create');
            Route::post('add', [AdminUserController::class, 'store'])->name('user.store');
            Route::get('{userId}/edit', [AdminUserController::class, 'edit'])->name('user.edit');
            Route::put('{userId}', [AdminUserController::class, 'update'])->name('user.update');

            
            Route::get('{userId}/proceedings', [AdminProceedingController::class, 'userProceedings'])->name('user.proceedings');
            Route::get('{userId}/proceeding/add', [AdminProceedingController::class, 'create'])->name('proceeding.create');
            Route::post('{userId}/proceeding/add', [AdminProceedingController::class, 'store'])->name('proceeding.store');

            Route::get('events', [AdminEventController::class, 'userNextEvents'])->name('user.events');
        });
        
        
    });
});