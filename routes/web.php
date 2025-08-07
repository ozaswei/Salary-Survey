<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScrapeController;
use App\Http\Controllers\SalarySurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SalarySurveyController::class, 'salarySurveyFrontPage'])->name('salarySurvey');
Route::post('/', [ScrapeController::class, 'scrape'])->name('runScraper');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
