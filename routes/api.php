<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnItemController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users', [authController::class, 'store']);
});

// Route::apiResource('posts', PostController::class);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// admin
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    //analytic perhari perbulan dan per tahun
    Route::get('/admin/analytic/{date}', [DashboardController::class, 'analytic']);

    Route::post('/admin/register', [AuthController::class, 'register']); //membuat akun untuk user
    Route::get('/admin/users', [UserController::class, 'index']); //menampilkan semua user
    Route::get('/admin/users/{user}', [AuthController::class, 'profile']); //menampilkan user berdasarkan id
    Route::put('/admin/users/edit/{user}', [AuthController::class, 'update']); //mengedit user berdasarkan id
    Route::delete('/admin/users/delete/{user}', [AuthController::class, 'destroy']); //menghapus user berdasarkan id

    Route::get('/admin/categories', [CategoriesController::class, 'index']); //menampilkan semua category
    Route::get('/admin/categories/{category}', [CategoriesController::class, 'show']); //menampilkan category berdasarkan id
    Route::post('/admin/categories', [CategoriesController::class, 'create']); //membuat category
    Route::put('/admin/categories/edit/{category}', [CategoriesController::class, 'update']); //mengedit category berdasarkan id
    Route::delete('/admin/categories/delete/{category}', [CategoriesController::class, 'destroy']); //menghapus category berdasarkan id
    // Route::apiResource('/admin/categories', CategoriesController::class);

    Route::get('/admin/units', [ItemMasterController::class, 'index']); //menampilkan semua unit
    Route::get('/admin/units/{unit}', [ItemMasterController::class, 'show']); //menampilkan unit berdasarkan id
    Route::post('/admin/units/create', [ItemMasterController::class, 'create']); //membuat unit
    Route::post('/admin/units/edit/{unit}', [ItemMasterController::class, 'update']); //mengedit unit berdasarkan id
    Route::delete('/admin/units/delete/{unit}', [ItemMasterController::class, 'destroy']); //menghapus unit berdasarkan id

    Route::get('/admin/loans', [LoanController::class, 'index']); //menampilkan semua loan
    Route::get('/admin/loans/{loan}', [LoanController::class, 'show']); //menampilkan loan berdasarkan id
    Route::post('/admin/loans/create', [LoanController::class, 'create']); //membuat loan
    Route::put('/admin/loans/edit/{loan}', [LoanController::class, 'update']); //mengedit loan berdasarkan id
    Route::delete('/admin/loans/delete/{loan}', [LoanController::class, 'destroy']); //menghapus loan berdasarkan id
    //admin approve or rejec
    Route::patch('/admin/loans/approve/{loan}', [LoanController::class, 'approve']); //approve loan berdasarkan id
    Route::patch('/admin/loans/reject/{loan}', [LoanController::class, 'reject']); //approve loan berdasarkan id

    Route::get('/admin/loans/{loan}/history', [LoanController::class, 'history']); //menampilkan history loan berdasarkan id
    Route::get('/admin/loans/{loan}/history/{history}', [LoanController::class, 'historyShow']); //menampilkan history loan berdasarkan id
    Route::post('/admin/loans/{loan}/history', [LoanController::class, 'historyCreate']); //membuat history
    Route::get('/admin/loans/{loan}/history/{history}/edit', [LoanController::class, 'historyUpdate']); //mengedit history loan berdasarkan id
    Route::delete('/admin/loans/{loan}/history/{history}/delete', [LoanController::class, 'historyDestroy']); //menghapus history loan berdasarkan id

    Route::get('/admin/return', [ReturnItemController::class, 'index']); //menampilkan semua return
    Route::get('/admin/return/return/{return}', [ReturnItemController::class, 'show']);
    Route::post('/return/return/{return}', [ReturnItemController::class, 'create']);
    Route::get('/admin/return/{loan}/return/{return}/edit', [ReturnItemController::class, 'update']);
    Route::delete('/admin/return/{loan}/return/{return}/delete', [ReturnItemController::class, 'destroy']);
});

//user
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [UserController::class, 'user']); //menampilkan user yang sedang login
    Route::get('/profile', [UserController::class, 'profile']); //menampilkan profile user
    Route::post('/profile/edit', [UserController::class, 'update']); //mengedit profile user

    Route::get('/user/units', [ItemMasterController::class, 'index']); //menampilkan semua unit
    Route::get('/user/units/{unit}', [ItemMasterController::class, 'show']); //menampilkan unit berdasarkan id

    Route::post('/user/loans', [LoanController::class, 'create']); //membuat loan
    Route::get('/user/loans/active', [LoanController::class, 'active']); //
    Route::get('/profile/loans', [LoanController::class, 'showUserLoans']); //menampilkan loan dari user yang sedang login
    

    Route::get('/profile/loans/notification', [LoanController::class, 'notification']); //menampilkan notifikasi loan yang sudah di approve
    Route::get('/profile/loans/notification/rejected', [LoanController::class, 'notificationRejected']); //menampilkan notifikasi loan yang ditolak

    Route::post('/profile/return', [ReturnItemController::class, 'create']); //membuat return item
    Route::get('/profile/return', [ReturnItemController::class, 'profileIndex']); //menampilkan semua return item

});
