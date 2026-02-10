<?php

use Illuminate\Support\Facades\Route;
use Modules\Etudiant\Http\Controllers\ContactController;
use Modules\Etudiant\Http\Controllers\DocumentController;
use Modules\Etudiant\Http\Controllers\EtudiantController;



Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('etudiant')->group(function() {
        Route::post('/', [EtudiantController::class, 'store'])->name('etudiants.store');
        Route::get('search/{keyword}', [EtudiantController::class, 'search'])->name('etudiants.search');
        Route::get('/liste', [EtudiantController::class, 'list'])->name('etudiants.liste');
        Route::get('/', [EtudiantController::class, 'index'])->name('etudiants.index');
        Route::get('/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
        Route::put('/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
        Route::delete('/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    });

    Route::prefix('contact')->group(function() {
        Route::post('/', [ContactController::class, 'store'])->name('contacts.store');
        Route::get('search/{keyword}', [ContactController::class, 'search'])->name('contacts.search');
        Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/liste', [ContactController::class, 'list'])->name('contacts.liste');
        Route::get('/{contact}', [ContactController::class, 'show'])->name('contacts.show');
        Route::put('/{contact}', [ContactController::class, 'update'])->name('contacts.update');
        Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    Route::prefix('document')->group(function() {
        Route::post('/', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('search/{keyword}', [DocumentController::class, 'search'])->name('documents.search');
        Route::get('/', [DocumentController::class, 'index'])->name('documents.index');
        Route::get('/liste', [DocumentController::class, 'list'])->name('documents.liste');
        Route::get('/{document}', [DocumentController::class, 'show'])->name('documents.show');
        Route::put('/{document}', [DocumentController::class, 'update'])->name('documents.update');
        Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    });
});
