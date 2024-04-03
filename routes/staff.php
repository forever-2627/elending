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

Route::middleware(StaffMiddleware::class)->group(function (){
    Route::get('/loans', [LoanController::class, 'index'])->name('staff.loans');
});