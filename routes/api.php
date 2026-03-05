<?php

    use App\Http\Controllers\ClientController;
    use Illuminate\Support\Facades\Route;

    Route::apiResource('clients', ClientController::class);

    Route::get('/clients/check-dni/{dni}', [ClientController::class, 'checkDni']);

?>