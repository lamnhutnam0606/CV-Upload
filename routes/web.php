<?php

use App\Http\Controllers\ApplyCVController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    // var_dump(Features::enabled(Features::registration()));
    return Inertia::render('welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

Route::middleware('web')->group(function () {
    Route::get('/apply-cv', [ApplyCVController::class, 'create'])->name('cv.apply.form');
    Route::post('/cv/parse', [ApplyCVController::class, 'parse'])->name('cv.parse');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/list', [ApplyCVController::class, 'list'])->name('cv.list');
});

require __DIR__.'/settings.php';
