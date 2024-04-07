<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/3/2024
 * Time: 4:31 PM
 */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Staff as StaffMiddleware;
use App\Http\Controllers\Staff\LoanController as StaffLoanController;
use App\Http\Controllers\Staff\UserController;

Route::middleware(StaffMiddleware::class)->group(function (){
    //Loans Route
    Route::get('staff/loans', [StaffLoanController::class, 'index'])->name('staff.loans');
    Route::get('staff/loans/create', [StaffLoanController::class, 'create'])->name('staff.loans.create');
    Route::post('staff/loans/store', [StaffLoanController::class, 'store'])->name('staff.loans.store');
    Route::get('staff/loans/view/{id}', [StaffLoanController::class, 'view'])->name('staff.loans.view');
    Route::get('staff/loans/edit/{id}', [StaffLoanController::class, 'edit'])->name('staff.loans.edit');
    Route::post('staff/loans/edit', [StaffLoanController::class, 'update'])->name('staff.loans.update');
    Route::get('staff/loans/delete/{id}', [StaffLoanController::class, 'delete'])->name('staff.loans.delete');

    //Users Route
    Route::get('staff/users', [UserController::class, 'index'])->name('staff.users');
    Route::get('staff/users/create', [UserController::class, 'create'])->name('staff.users.create');
    Route::post('staff/users/store', [UserController::class, 'store'])->name('staff.users.store');
    Route::get('staff/users/edit/{id}', [UserController::class, 'edit'])->name('staff.users.edit');
    Route::post('staff/users/edit', [UserController::class, 'update'])->name('staff.users.update');
    Route::get('staff/users/delete/{id}', [UserController::class, 'delete'])->name('staff.users.delete');
});