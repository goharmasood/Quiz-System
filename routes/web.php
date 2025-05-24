<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryTypeController;
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('login');
});

Route::view("login", "login");

Route::post("login", [AuthController::class, 'login']);
Route::get("dashboard", [DashboardController::class, 'dashboard']);
Route::get("inventorytype", [InventoryTypeController::class, 'getInventoryTypes']);
Route::get("logout", [AuthController::class, 'logout']);
Route::post("addinventorytype", [InventoryTypeController::class, 'addInventoryType']);
Route::get("inventorytype/delete/{id}", [InventoryTypeController::class, 'deleteInventoryType']);
Route::get("inventories", [InventoryController::class, 'getInventoriesDetails']);
Route::post("addinventory", [InventoryController::class, 'addInventory']);

