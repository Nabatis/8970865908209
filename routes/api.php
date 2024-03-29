<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\Durasipeminjaman;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RiwayatController;
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
    // Route::put('users/{id}/ban', [AuthController::class, 'banUser']);
});

Route::get('reset-password', [ResetPasswordController::class, 'resetPasswordLoad']);
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);

// ADMIN
// buku
Route::post('editBuku/{id}', [BukuController::class, 'editBuku']);
Route::post('tambahBuku', [BukuController::class, 'tambahBuku']);
Route::delete('deleteBuku/{id}', [BukuController::class, 'deleteBuku']);
Route::put('tambah-stok-buku/{id}', [BukuController::class, 'tambahStokBuku']);
Route::post('updateStatus/{id}', [BukuController::class, 'updateStatus']);
Route::get('getPeminjaman', [PeminjamanController::class, 'getPeminjaman']);

Route::post('tambahKategori', [KategoriController::class, 'store']);
Route::post('updateKategori/{id}', [KategoriController::class, 'updateKategori']);
Route::delete('deleteKategori/{id}', [KategoriController::class, 'deleteKategori']);

Route::get('getDurasiPeminjaman', [Durasipeminjaman::class, 'getDurasiPinjam']);
Route::get('getDurasiPeminjaman/{id}', [Durasipeminjaman::class, 'show']);
Route::post('storeDurasiPeminjaman', [Durasipeminjaman::class, 'store']);
Route::post('updateDurasiPeminjaman/{id}', [Durasipeminjaman::class, 'update']);
Route::delete('deleteDurasiPeminjaman/{id}', [Durasipeminjaman::class, 'delete']);
Route::get('getJumlahPeminjamanByYearAndMonth', [PeminjamanController::class, 'getJumlahPeminjamanByYearAndMonth']);

Route::get('gettotaldataadmin', [RiwayatController::class, 'gettotaldataadmin']);

Route::get('getPeminjamanstatustertunda', [PeminjamanController::class, 'getPeminjamanstatustertunda']);




// dll
Route::delete('deleteReviews/{id}', [ReviewController::class, 'destroy']);

Route::get('searchUser/{name}', [DeviceController::class, 'searchUser']);
Route::delete('deleteUser/{id}', [DeviceController::class, 'deleteUser']);
Route::get('getAllUser', [DeviceController::class, 'getAllUser']);

// denda
Route::get('indexDendaByUser/{userId}', [DendaController::class, 'indexDendaByUser']);
Route::get('hitungDenda/{id_peminjaman}', [DendaController::class, 'hitungDenda']);
Route::get('dataDenda', [DendaController::class, 'index']);
Route::get('dataDenda/{id}', [DendaController::class, 'show']);
Route::post('dataDenda', [DendaController::class, 'storeOrUpdate']);
Route::post('updateBayar/{id}', [DendaController::class, 'updateBayar']);


Route::get('reminderEmail/{id}', [DendaController::class, 'sendReminderEmail']);


// USER
Route::post('peminjaman', [PinjamController::class, 'pinjamBukuUser']);
Route::get('dataBuku', [BukuController::class, 'getBuku']);
Route::get('paginationBuku', [BukuController::class, 'getPaginationBuku']);
Route::get('dataBukuPopuler', [BukuController::class, 'getBukuHighRating']);
Route::get('detailBuku/{id}', [BukuController::class, 'detailBuku']);
Route::get('searchBuku', [BukuController::class, 'search']);
Route::get('total-rating-all-book', [BukuController::class, 'getTotalRatingAllBook']);
Route::post('submitBorrowingRequest', [BukuController::class, 'submitBorrowingRequest']);
Route::post('submitPeminjaman', [BukuController::class, 'submitPeminjaman']);

Route::get('getPeminjamanbyuser/{userId}', [RiwayatController::class, 'getPeminjamanbyuser']);



Route::post('reviews', [ReviewController::class, 'store']);
Route::get('total-rating/{id_buku}', [ReviewController::class, 'getTotalRating']);
Route::get('getReviews', [ReviewController::class, 'getUlasan']);
Route::get('getReviews/{bookId}', [ReviewController::class, 'getUlasanByBookId']);

Route::post('bookmark/add', [BookmarkController::class, 'addToBookmark']);
Route::delete('unbookmark', [BookmarkController::class, 'unbookmark']);
Route::get('getBookmark/{userId}', [BookmarkController::class, 'getBookmark']);

Route::get('dataKategori/{id}', [KategoriController::class, 'show']);
Route::get('dataKategori', [KategoriController::class, 'index']);

Route::post('/start-payment', [MidtransController::class, 'startPayment']);
