<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => ['web', 'checkRole:user']], function () {
    Route::get('/profile', function () {
        return view('profile');
    });
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/forget-password', function () {
    return view('forget-password');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/detail-buku', function () {
    return view('detail-buku');
});


Route::get('/verify-mail/{token}', [ProfileController::class, 'verificationEmail']);
Route::get('/reset-password', [ResetPasswordController::class, 'resetPasswordLoad']);
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword']);
