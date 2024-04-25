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
use App\Http\Controllers\Staff\MessageController as StaffMessageController;
use App\Http\Controllers\Staff\NotificationController;
use App\Http\Controllers\Staff\UserController;
use App\Http\Controllers\Staff\RepaymentController;

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

    //Notifications
    Route::get('staff/notifications', [NotificationController::class, 'index'])->name('staff.notifications');
    Route::get('staff/notifications/view/{id}', [NotificationController::class, 'view'])->name('staff.notifications.view');
    Route::get('staff/notifications/confirm/{id}', [NotificationController::class, 'approve_update_profile'])->name('staff.notifications.approve.update.profile');
    Route::get('staff/notifications/check/{id}', [NotificationController::class, 'check'])->name('staff.notifications.check');
    Route::get('staff/notifications/delete/{id}', [NotificationController::class, 'delete'])->name('staff.notifications.delete');

    //Messages
    Route::get('staff/messages', [StaffMessageController::class, 'index'])->name('staff.messages');
    Route::get('staff/messages/view/{id}', [StaffMessageController::class, 'view'])->name('staff.messages.view');
    Route::get('staff/messages/check/{id}', [StaffMessageController::class, 'check'])->name('staff.messages.check');
    Route::get('staff/messages/delete/{id}', [StaffMessageController::class, 'delete'])->name('staff.messages.delete');

    //Repayments
    Route::get('staff/repayments', [RepaymentController::class, 'index'])->name('staff.repayments');
    Route::get('staff/repayments/create', [RepaymentController::class, 'create'])->name('staff.repayments.create');
    Route::post('staff/repayments/store', [RepaymentController::class, 'store'])->name('staff.repayments.store');
    Route::get('staff/repayments/edit/{id}', [RepaymentController::class, 'edit'])->name('staff.repayments.edit');
    Route::post('staff/repayments/edit', [RepaymentController::class, 'update'])->name('staff.repayments.update');
    Route::get('staff/repayments/delete/{id}', [RepaymentController::class, 'delete'])->name('staff.repayments.delete');

    //Others
    Route::get('staff/calculator', function (){ return view('admin.calculator');})->name('staff.calculator');

});