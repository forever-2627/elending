<?php
/**
 * Created by PhpStorm.
 * User: 585
 * Date: 4/3/2024
 * Time: 4:31 PM
 */

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin as AdminMiddleware;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::middleware(AdminMiddleware::class)->group(function (){
    Route::get('/admin/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
});