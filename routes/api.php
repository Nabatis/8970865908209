<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout']);
    // Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('forget-password', [AuthController::class, 'forgetPassword']);
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::post('update-profile', [ProfileController::class, 'updateProfile']);
    Route::get('send-verify-mail/{email}', [ProfileController::class, 'sendVerifyMail']);
    Route::put('users/{id}/ban', [AuthController::class, 'banUser']);
});

Route::post('peminjaman', [BukuController::class, 'pinjamBuku']);
Route::get('dataBuku', [BukuController::class, 'getBuku']);
Route::get('detailBuku/{id}', [BukuController::class, 'detailBuku']);
Route::post('tambahBuku', [BukuController::class, 'tambahBuku']);
Route::post('editBuku/{id}', [BukuController::class, 'editBuku']);
Route::get('searchBuku', [BukuController::class, 'search']);
Route::post('reviews', [ReviewController::class, 'store']);
Route::delete('deleteReviews/{id}', [ReviewController::class, 'destroy']);
Route::get('total-rating/{id_buku}', [ReviewController::class, 'getTotalRating']);
Route::get('total-rating-all-book', [ReviewController::class, 'getTotalRatingAllBook']);
Route::get('getReviews', [ReviewController::class, 'getUlasan']);
Route::post('bookmark/add', [BookmarkController::class, 'addToBookmark']);
Route::delete('unbookmark', [BookmarkController::class, 'unbookmark']);
Route::post('updateStatus/{id}', [BukuController::class, 'updateStatus']);
Route::put('tambah-stok-buku/{id}', [BukuController::class, 'tambahStokBuku']);

Route::post('tambahKategori', [KategoriController::class, 'store']);
Route::get('dataKategori/{id}', [KategoriController::class, 'show']);


Route::get('searchUser/{name}', [DeviceController::class, 'searchUser']);
