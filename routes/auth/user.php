<?php

use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\ConfirmablePasswordController;
use App\Http\Controllers\User\EmailVerificationNotificationController;
use App\Http\Controllers\User\EmailVerificationPromptController;
use App\Http\Controllers\User\NewPasswordController;
use App\Http\Controllers\User\PasswordResetLinkController;
use App\Http\Controllers\User\RegisteredUserController;
use App\Http\Controllers\User\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create'])
                ->middleware('guest:users')
                ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
                ->middleware('guest:users');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest:users')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest:users');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest:users')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest:users')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest:users')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest:users')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth:users')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth:users', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth:users', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth:users')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth:users');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth:users')
                ->name('logout');
