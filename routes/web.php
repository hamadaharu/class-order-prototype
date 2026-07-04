<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->hasRole('admin')) {
        $pendingBookingsCount = App\Models\Booking::where('status', 'pending')->count();
        $totalRooms = App\Models\Room::count();
        return view('dashboard', compact('pendingBookingsCount', 'totalRooms'));
    } else {
        $upcomingBookings = App\Models\Booking::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('start_at', '>', now())
            ->orderBy('start_at')
            ->take(3)->get();
        return view('dashboard', compact('upcomingBookings'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('rooms', App\Http\Controllers\RoomController::class);
    
    Route::resource('bookings', App\Http\Controllers\BookingController::class)->except(['edit', 'update', 'destroy']);
    Route::post('bookings/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('bookings/{booking}/approve', [App\Http\Controllers\BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/reject', [App\Http\Controllers\BookingController::class, 'reject'])->name('bookings.reject');
});

require __DIR__.'/auth.php';
