<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\MessageController as GuestMessageController;
use Illuminate\Support\Facades\Artisan;
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

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
require __DIR__ . '/user.php';

use Illuminate\Support\Facades\Mail;

Route::get('/send-test-email', function () {
    $details = [
        'title' => 'Test Email',
        'body' => 'This is a test email from support@ismblending.com.'
    ];

    try {
        Mail::to('daniellubis@outlook.com')->send(new \App\Mail\TestEmail($details));
        return 'Email sent successfully!';
    } catch (\Exception $e) {
        return 'Failed to send email. ' . $e->getMessage();
    }
});

Route::get('/test', function () {
    $url = "https://ismblending.com"; // Replace with your actual domain

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    ob_start();
    curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
    $output = ob_get_clean();

    if ($output === false) {
        echo "Error: " . curl_error($ch);
    } else {
        dd($info);
    }
});

Route::get('/migrate', function(){
    Artisan::call('migrate', array('--force' => true));
    return redirect()->back();
});

Route::get('/key-clear', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Config and Cache Cleared';
});