<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OAuth\OAuthProviderCallbackController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/latests', [IndexController::class, 'latests'])->name('index.latests');
Route::get('/evaluations', [IndexController::class, 'evaluations'])->name('index.evaluations');
Route::get('/bookmarks', [IndexController::class, 'bookmarks'])->name('index.bookmarks');
Route::get('/storedetail', [IndexController::class, 'storedetail'])->name('index.storedetail');
Route::get('/productdetail', [IndexController::class, 'productdetail'])->name('index.productdetail');
Route::get('/search/simplesearch', [SearchController::class, 'simplesearch'])->name('search.simplesearch');
Route::get('/search/detailsearch', [SearchController::class, 'detailsearch'])->name('search.detailsearch');
Route::get('/support/contact', [SupportController::class, 'contact'])->name('support.contact');

Route::get('/oauth/social-login/{provider}/callback', OAuthProviderCallbackController::class)
                ->where(['provider' => '(twitter|facebook|google)'])
                ->name('oauth.social.callback');

//ユーザー認証および専用ページのルーティング
Route::prefix('user')->name('user.')->group(function() {
    Route::get('/', function () {
        return view('user.index');
    })->middleware(['auth:users', 'verified:user.verification.notice'])->name('index');

    //ユーザー認証
    require __DIR__.'/auth/user.php';
});

//オーナー認証および専用ページのルーティング
Route::prefix('owner')->name('owner.')->group(function() {
    Route::get('/', function () {
        return view('owner.index');
    })->middleware(['auth:owners', 'verified:owner.verification.notice'])->name('index');

    //オーナー認証
    require __DIR__.'/auth/owner.php';
});
