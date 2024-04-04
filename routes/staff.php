<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/3/2024
 * Time: 4:31 PM
 */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Staff as StaffMiddleware;
use App\Http\Controllers\Staff\LoanController;
use App\Http\Controllers\Staff\UserController;

Route::middleware(StaffMiddleware::class)->group(function (){
    Route::get('/loans', [LoanController::class, 'index'])->name('staff.loans');

    //Users Route
    Route::get('/users', [UserController::class, 'index'])->name('staff.users');
    Route::get('/users/create', [UserController::class, 'create'])->name('staff.users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('staff.users.store');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('staff.users.edit');
    Route::post('/users/edit', [UserController::class, 'update'])->name('staff.users.update');
    Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('staff.users.delete');
});