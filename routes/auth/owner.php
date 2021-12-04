<?php

use App\Http\Controllers\Owner\AuthenticatedSessionController;
use App\Http\Controllers\Owner\ConfirmablePasswordController;
use App\Http\Controllers\Owner\EmailVerificationNotificationController;
use App\Http\Controllers\Owner\EmailVerificationPromptController;
use App\Http\Controllers\Owner\NewPasswordController;
use App\Http\Controllers\Owner\PasswordResetLinkController;
use App\Http\Controllers\Owner\RegisteredUserController;
use App\Http\Controllers\Owner\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:owners')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:owners');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:owners')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:owners');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:owners')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:owners')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:owners')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:owners')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:owners')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:owners', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:owners', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:owners')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:owners');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:owners')
                ->name('logout');
