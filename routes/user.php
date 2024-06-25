<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/3/2024
 * Time: 4:32 PM
 */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\User as UserMiddleware;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\LoanController as UserLoanController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\User\ContactController as UserContactController;
use App\Http\Controllers\User\MessageController as UserMessageController;


Route::middleware(UserMiddleware::class)->group(function (){
    Route::get('/user/dashboard', [ UserDashboardController::class, 'index' ])->name('user.dashboard');
    Route::get('/user/loans', [ UserLoanController::class, 'index' ])->name('user.loans');

    Route::get('/user/edit_profile', [ UserProfileController::class, 'edit_profile' ])->name('user.profile.edit');
    Route::post('/user/edit_profile', [UserProfileController::class, 'profile_update_request'])->name('user.profile.update');
    Route::get('/user/change_password', [ UserProfileController::class, 'change_password' ])->name('user.password.change');
    Route::post('/user/change_password', [UserProfileController::class, 'password_update_request'])->name('user.password.update');

    Route::get('/user/contact', [ UserContactController::class, 'index' ])->name('user.contact');
    Route::post('/user/message', [ UserMessageController::class, 'store'])->name('user.message.store');

});

Route::get('/user/loans/request/{token}', [UserLoanController::class, 'request_loan'])->name('user.request.loan');
Route::post('/user/loans/request', [UserLoanController::class, 'store_requested_loan'])->name('user.request.loan.store');
