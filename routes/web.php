<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoorTypeController;

Route::get('/', function () {
    return view('login');
});

Route::view("login", "login");

Route::post("login", [AuthController::class, 'login']);
Route::get("dashboard", [DashboardController::class, 'dashboard']);
Route::get("doortypes", [DoorTypeController::class, 'getDoorTypes']);
Route::get("logout", [AuthController::class, 'logout']);
Route::post("adddoortype", [DoorTypeController::class, 'addDoorType']);

