<?php
use App\Http\Controllers\BillController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvitationController;


use Illuminate\Support\Facades\Route;

Route::get('/landingpage', function () {
    return view('landingpage');
});
Route::get('/guest', function () {
    return view('guest.guestpage'); // Ensure guest.blade.php exists in resources/views
});
Route::prefix('api')->group(function () {
    Route::apiResource('bills', BillController::class);
    Route::post('participants', [ParticipantController::class, 'store']);
    Route::post('payments', [PaymentController::class, 'store']);
    Route::post('invitations', [InvitationController::class, 'store']);
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');