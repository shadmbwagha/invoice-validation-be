<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceUploadController;
use App\Http\Controllers\OCRTextExtractionControlller;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/change-password', [UserController::class, 'changePassword']);
Route::post('/upload-image', [UserController::class, 'uploadImage']);
Route::post('/change-personal-info', [UserController::class, 'changePersonalInfo']);

Route::post('/invoices/upload', [InvoiceUploadController::class, 'upload']);
Route::get('/invoices', [InvoiceUploadController::class, 'getInvoices']);

Route::get('/invoices/{id}/extract-text', [OCRTextExtractionControlller::class, 'extractText']);