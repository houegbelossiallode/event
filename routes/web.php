<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealisationController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/realisations', [RealisationController::class, 'index'])->name('realisation.index');
Route::get('/realisations/{id}/edit', [RealisationController::class, 'edit'])->name('realisation.edit');
Route::put('/realisations/{id}', [RealisationController::class, 'update'])->name('realisation.update');
Route::delete('/realisations/{id}', [RealisationController::class, 'destroy'])->name('realisation.destroy');
Route::post('/import', [RealisationController::class, 'import'])->name('realisation.import');
Route::get('/events', [EventController::class, 'index'])->name('event.index');
Route::get('/tickets/liste/', [TicketController::class, 'liste'])->name('ticket.liste');
Route::get('/tickets/{ticket}/imprimer', [TicketController::class, 'imprimer'])->name('tickets.imprimer');
Route::post('/payment', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/ticket/success/{id}', [PaymentController::class, 'success'])->name('ticket.success');
Route::get('/ticket/error', [PaymentController::class, 'error'])->name('ticket.error');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';