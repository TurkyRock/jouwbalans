<?php

use App\Livewire\BalanceCalendar;
use App\Livewire\BalanceDashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', BalanceDashboard::class)->name('dashboard');
    Route::get('mijn-kalender', BalanceCalendar::class)->name('balance.calendar');
});

require __DIR__.'/settings.php';
