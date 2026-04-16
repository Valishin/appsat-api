<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

    Route::get('/clients/search', [ClientController::class, 'search']);
    Route::get('/clients/check-dni/{dni}', [ClientController::class, 'checkDni']);
    Route::apiResource('clients', ClientController::class);

    Route::apiResource('devices', DeviceController::class);

    Route::apiResource('client_addresses', AddressController::class);

?>