<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->prefix('employees')->name('employees.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
    Route::get('/restore', [EmployeeController::class, 'restore'])->name('restore');
    Route::post('/bulk-delete', [EmployeeController::class, 'bulkDelete'])->name('bulkDelete');

    Route::get('/departments', [EmployeeController::class, 'departments'])->name('departments');
});
