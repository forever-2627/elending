<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\MessageController as GuestMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth as AuthMiddleware;

Route::middleware(AuthMiddleware::class)->get('/', function () {
    return view('guest.home');
})->name('home');

Route::middleware(AuthMiddleware::class)->get('/privacy', function () {
    return view('guest.privacy');
})->name('privacy');

Route::middleware(AuthMiddleware::class)->get('/terms', function () {
    return view('guest.terms');
})->name('terms');


Route::middleware(AuthMiddleware::class)->post('/loan-request', [GuestMessageController::class, 'loan_requested'])->name('guest.loan.requested');

Route::get('/dashboard', function () {
    return redirect(\route('user.dashboard'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/message', [GuestMessageController::class, 'store'])->name('guest.message.store');

Route::get('/test', function () {
    \App\Models\DueLoan::truncate();
})->name('test');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/staff.php';
require __DIR__.'/user.php';
