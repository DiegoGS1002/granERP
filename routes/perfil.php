<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\LogsController;

Route::middleware('admin')->group(function () {
	Route::resource('users', UsersController::class)
		->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

	Route::resource('permissions', PermissionsController::class);
	Route::resource('logs', LogsController::class);
});

