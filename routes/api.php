<?php

namespace App\Http\Middleware;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemMasterController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PostController;
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

    Route::post('/admin/register', [AuthController::class, 'register']); //membuat akun untuk user
    Route::get('/admin/users', [UserController::class, 'index']); //menampilkan semua user
    Route::get('/admin/users/{user}', [AuthController::class, 'profile']); //menampilkan user berdasarkan id
    Route::put('/admin/users/{user}/edit', [AuthController::class, 'update']); //mengedit user berdasarkan id
    Route::post('/admin/users/{user}/delete', [AuthController::class, 'destroy']); //menghapus user berdasarkan id

    Route::get('/admin/categories', [CategoriesController::class, 'index']); //menampilkan semua category
    Route::get('/admin/categories/{category}', [CategoriesController::class, 'show']); //menampilkan category berdasarkan id
    Route::post('/admin/categories', [CategoriesController::class, 'create']); //membuat category
    Route::put('/admin/categories/{category}/edit', [CategoriesController::class, 'update']); //mengedit category berdasarkan id
    Route::delete('/admin/categories/{category}/delete', [CategoriesController::class, 'destroy']); //menghapus category berdasarkan id
    // Route::apiResource('/admin/categories', CategoriesController::class);

    Route::get('/admin/units', [ItemMasterController::class, 'index']); //menampilkan semua unit
    Route::get('/admin/units/{unit}', [ItemMasterController::class, 'show']); //menampilkan unit berdasarkan id
    Route::post('/admin/units', [ItemMasterController::class, 'create']); //membuat unit
    Route::put('/admin/units/{unit}/edit', [ItemMasterController::class, 'update']); //mengedit unit berdasarkan id
    Route::delete('/admin/units/{unit}/delete', [ItemMasterController::class, 'destroy']); //menghapus unit berdasarkan id

    Route::get('/admin/loans', [LoanController::class, 'index']); //menampilkan semua loan
    Route::get('/admin/loans/{loan}', [LoanController::class, 'show']); //menampilkan loan berdasarkan id
    Route::post('/admin/loans/create', [LoanController::class, 'create']); //membuat loan
    Route::put('/admin/loans/{loan}/edit', [LoanController::class, 'update']); //mengedit loan berdasarkan id
    Route::delete('/admin/loans/{loan}/delete', [LoanController::class, 'destroy']); //menghapus loan berdasarkan id
    //admin approve or rejec
    Route::patch('/admin/loans/approve/{loan}', [LoanController::class, 'approve']); //approve loan berdasarkan id
    Route::patch('/admin/loans/reject/{loan}', [LoanController::class, 'reject']); //approve loan berdasarkan id

    Route::get('/admin/loans/{loan}/history', [LoanController::class, 'history']); //menampilkan history loan berdasarkan id
    Route::get('/admin/loans/{loan}/history/{history}', [LoanController::class, 'historyShow']); //menampilkan history loan berdasarkan id
    Route::post('/admin/loans/{loan}/history', [LoanController::class, 'historyCreate']); //membuat history
    Route::get('/admin/loans/{loan}/history/{history}/edit', [LoanController::class, 'historyUpdate']); //mengedit history loan berdasarkan id
    Route::delete('/admin/loans/{loan}/history/{history}/delete', [LoanController::class, 'historyDestroy']); //menghapus history loan berdasarkan id

    Route::get('/admin/loans/{loan}/return', [ReturnItemController::class, 'index']); //menampilkan semua return
    Route::get('/admin/loans/{loan}/return/{return}', [ReturnItemController::class, 'show']);
    Route::post('/admin/loans/{loan}/return', [ReturnItemController::class, 'create']);
    Route::get('/admin/loans/{loan}/return/{return}/edit', [ReturnItemController::class, 'update']);
    Route::delete('/admin/loans/{loan}/return/{return}/delete', [ReturnItemController::class, 'destroy']);
});

//user
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'user']);
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/user/categories', [CategoriesController::class, 'index']); //menampilkan semua category
    Route::get('/user/categories/{category}', [CategoriesController::class, 'show']); //menampilkan category berdasarkan id
    Route::get('/user/units', [ItemMasterController::class, 'index']); //menampilkan semua unit
    Route::get('/user/units/{unit}', [ItemMasterController::class, 'show']); //menampilkan unit berdasarkan id

    Route::get('/user/loans', [LoanController::class, 'index']); //menampilkan semua loan
    Route::get('/user/loans/{loan}', [LoanController::class, 'show']); //menampilkan loan berdasarkan id
    Route::post('/user/loans', [LoanController::class, 'create']); //membuat loan


});
