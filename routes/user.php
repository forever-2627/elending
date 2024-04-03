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


Route::middleware(UserMiddleware::class)->group(function (){
    Route::get('/user/dashboard', [ UserDashboardController::class, 'index' ])->name('user.dashboard');
});