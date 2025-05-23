<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GoogleAuthController;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

Route::get('/', [ProjectController::class, 'create'])->name('project.create');
Route::post('/project/submit', [ProjectController::class, 'store'])->name('project.store');
Route::get('/project/{project}/confirm-fee', [ProjectController::class, 'confirmFee'])->name('project.confirmFee');
Route::get('/project/{project}/success', [ProjectController::class, 'success'])->name('project.success');

Route::middleware('auth')->group(function () {});
