<?php

use Illuminate\Support\Facades\Route;
use Modules\Etudiant\Http\Controllers\EtudiantController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('etudiants', EtudiantController::class)->names('etudiant');
});
