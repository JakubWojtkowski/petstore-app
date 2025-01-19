<?php

use App\Http\Controllers\PetController;

Route::prefix('/pet')->group(function () {
    Route::get('/status', [PetController::class, 'getPetsByStatus']); // Get pets by its status
    Route::get('/{id}', [PetController::class, 'getPetById']); // Get pet by id
    Route::post('/', [PetController::class, 'addPet']); // Add pet
    Route::post('/{id}/uploadImage', [PetController::class, 'uploadImage']); // Upload image
    Route::put('/', [PetController::class, 'updatePet']); // Update pet
    Route::delete('/{id}', [PetController::class, 'deletePet']); // Delete pet
});
