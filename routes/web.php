<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return to_route('dashboard');
    })->name('home');

    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

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
