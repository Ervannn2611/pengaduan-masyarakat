<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ComenController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\HeadStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ResponController;
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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('reports')->name('reports.')->middleware('IsGuest')->group(function () {
    Route::get('/dashboard', [LayananController::class, 'index'])->name('dashboard');
    Route::get('/create', [LayananController::class, 'create'])->name('create');
    Route::post('/create', [LayananController::class, 'store'])->name('store');
    Route::get('/detail', [LayananController::class, 'detail'])->name('detail');
    Route::get('/article/{id}', [LayananController::class, 'show'])->name('show');
    Route::delete('/reports/{id}', [LayananController::class, 'destroy'])->name('destroy');
    Route::post('/comen', [ComenController::class, 'store'])->name('comen');
    Route::post('/voting/{id}', [VotingController::class, 'vote'])->name('voting');
    Route::get('/search', [LayananController::class, 'search'])->name('search');

});
Route::prefix('headstaff')->name('headstaff.')->middleware('IsHeadStaff')->group(function(){
    Route::get('/dashboard', [HeadStaffController::class,'index'])->name('dashboard');
    Route::get('/create', [HeadStaffController::class,'create'])->name('create');
    Route::post('/create/store', [HeadStaffController::class,'store'])->name('store');
    Route::delete('destroy/{id}', [HeadStaffController::class,'destroy'])->name('destroy');
});

Route::prefix('staff')->name('staff.')->middleware('IsStaff')->group(function(){
    Route::get('/dashboard', [StaffController::class,'index'])->name('dashboard');
    Route::get('/staff/detail/{id}', [StaffController::class, 'show'])->name('detail');
    Route::post('staff/store/{id}', [StaffController::class, 'store'])->name('store');
    Route::post('/response/update/{id}', [ResponController  ::class, 'updateStatus'])->name('update');
    Route::put('/response/done/{response}', [ResponController   ::class, 'markAsDone'])->name('done');
    Route::get('/export-staff', [LayananController::class, 'export'])->name('export');
});

