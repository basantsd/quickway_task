<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth'])->group(function () {
    Route::get('/',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', function () {
        return view('tasks');
    })->name('tasks');

    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('is.admin');
    Route::patch('/users/edit', [UserController::class, 'update'])->name('users.update')->middleware('is.admin');
    Route::delete('/users/delete', [UserController::class, 'destroy'])->name('users.destroy')->middleware('is.admin');


    Route::get('/task/view/{id}',[TaskController::class,'show'])->name('task-view');
});





require __DIR__.'/auth.php';
