<?php

use Illuminate\Support\Facades\Route;
use Modules\Note\Http\Controllers\NoteController;






Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('note')->group(function() {
        Route::post('/', [NoteController::class, 'store'])->name('notes.store');
        Route::get('search/{keyword}', [NoteController::class, 'search'])->name('notes.search');
        Route::get('/liste', [NoteController::class, 'list'])->name('notes.liste');
        Route::get('/', [NoteController::class, 'index'])->name('notes.index');
        Route::get('/{note}', [NoteController::class, 'show'])->name('notes.show');
        Route::put('/{note}', [NoteController::class, 'update'])->name('notes.update');
        Route::delete('/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
    });
});
