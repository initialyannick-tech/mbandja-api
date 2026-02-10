<?php

use Illuminate\Support\Facades\Route;
use Modules\Academique\Http\Controllers\AcademiqueController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('academiques', AcademiqueController::class)->names('academique');
});
