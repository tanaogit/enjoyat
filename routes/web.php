<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\SearchController;
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

Route::get('/search/simplesearch', [SearchController::class, 'simplesearch'])->name('search.simplesearch');
Route::get('/search/detailsearch', [SearchController::class, 'detailsearch'])->name('search.detailsearch');

// 使わないから一旦コメントアウト(後々消す)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
