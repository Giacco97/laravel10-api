<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UsersController::class, 'index']);
Route::post('users', [UsersController::class, 'store']);
Route::get('users/{id}', [UsersController::class, 'show']);
Route::get('users/edit/{id}', [UsersController::class, 'edit']);
Route::put('users/update/{id}', [UsersController::class, 'update']);
Route::delete('users/delete/{id}', [UsersController::class, 'delete']);