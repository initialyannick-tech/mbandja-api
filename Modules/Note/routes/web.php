<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('notes', NoteController::class)->names('note');
});
