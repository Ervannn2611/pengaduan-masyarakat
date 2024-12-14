<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ComenController;
use App\Http\Controllers\VotingController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing_page');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/dashboard', [LayananController::class, 'index'])->name('dashboard');

Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/create', [LayananController::class, 'create'])->name('create');
    Route::post('/create', [LayananController::class, 'store'])->name('store');
    Route::get('/detail', [LayananController::class, 'detail'])->name('detail');
    Route::get('/article/{id}', [LayananController::class, 'show'])->name('show');
    Route::delete('/reports/{id}', [LayananController::class, 'destroy'])->name('destroy');
    Route::post('/comen', [ComenController::class, 'store'])->name('comen');
    Route::post('/voting/{id}', [VotingController::class, 'voting'])->name('voting');
});


