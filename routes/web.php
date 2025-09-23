<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return to_route('dashboard');
    })->name('home');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('sites', function () {
        return Inertia::render('Sites');
    })->name('sites');

    Route::get('mrtg', function () {
        return Inertia::render('MRTG');
    })->name('mrtg');

    Route::get('domains', function () {
        return Inertia::render('Domains');
    })->name('domains');

    Route::get('servers', function () {
        return Inertia::render('Servers');
    })->name('servers');

    Route::get('ips', function () {
        return Inertia::render('IPs');
    })->name('ips');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
