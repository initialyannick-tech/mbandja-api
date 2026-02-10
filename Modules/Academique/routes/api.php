<?php

use Illuminate\Support\Facades\Route;
use Modules\Academique\Http\Controllers\ClasseController;
use Modules\Academique\Http\Controllers\CycleController;
use Modules\Academique\Http\Controllers\MatiereController;
use Modules\Academique\Http\Controllers\SemestreController;
use Modules\Academique\Http\Controllers\SessionController;
use Modules\Academique\Http\Controllers\UniteController;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('sessions')->group(function() {
        Route::post('/', [SessionController::class, 'store'])->name('sessions.store');
        Route::get('search/{keyword}', [SessionController::class, 'search'])->name('sessions.search');
        Route::get('/liste', [SessionController::class, 'list'])->name('sessions.liste');
        Route::get('/', [SessionController::class, 'index'])->name('sessions.index');
        Route::get('/{sessions}', [SessionController::class, 'show'])->name('sessions.show');
        Route::put('/{sessions}', [SessionController::class, 'update'])->name('sessions.update');
        Route::delete('/{sessions}', [SessionController::class, 'destroy'])->name('sessions.destroy');
    });

    Route::prefix('semestres')->group(function() {
        Route::post('/', [SemestreController::class, 'store'])->name('semestres.store');
        Route::get('search/{keyword}', [SemestreController::class, 'search'])->name('semestres.search');
        Route::get('/', [SemestreController::class, 'index'])->name('semestres.index');
        Route::get('/liste', [SemestreController::class, 'list'])->name('semestres.liste');
        Route::get('/{semestres}', [SemestreController::class, 'show'])->name('semestres.show');
        Route::put('/{semestres}', [SemestreController::class, 'update'])->name('semestres.update');
        Route::delete('/{semestres}', [SemestreController::class, 'destroy'])->name('semestres.destroy');
    });

    Route::prefix('cycles')->group(function() {
        Route::post('/', [CycleController::class, 'store'])->name('cycles.store');
        Route::get('search/{keyword}', [CycleController::class, 'search'])->name('cycles.search');
        Route::get('/', [CycleController::class, 'index'])->name('cycles.index');
        Route::get('/liste', [CycleController::class, 'list'])->name('cycles.liste');
        Route::get('/{cycles}', [CycleController::class, 'show'])->name('cycles.show');
        Route::put('/{cycles}', [CycleController::class, 'update'])->name('cycles.update');
        Route::delete('/{cycles}', [CycleController::class, 'destroy'])->name('cycles.destroy');
    });


    Route::prefix('classes')->group(function() {
        Route::post('/', [ClasseController::class, 'store'])->name('classes.store');
        Route::get('search/{keyword}', [ClasseController::class, 'search'])->name('classes.search');
        Route::get('/', [ClasseController::class, 'index'])->name('classes.index');
        Route::get('/liste', [ClasseController::class, 'list'])->name('classes.liste');
        Route::get('/{classes}', [ClasseController::class, 'show'])->name('classes.show');
        Route::put('/{classes}', [ClasseController::class, 'update'])->name('classes.update');
        Route::delete('/{classes}', [ClasseController::class, 'destroy'])->name('classes.destroy');
    });

    Route::prefix('unites')->group(function() {
        Route::post('/', [UniteController::class, 'store'])->name('unites.store');
        Route::get('search/{keyword}', [UniteController::class, 'search'])->name('unites.search');
        Route::get('/', [UniteController::class, 'index'])->name('unites.index');
        Route::get('/liste', [UniteController::class, 'list'])->name('unites.liste');
        Route::get('/{unites}', [UniteController::class, 'show'])->name('unites.show');
        Route::put('/{unites}', [UniteController::class, 'update'])->name('unites.update');
        Route::delete('/{unites}', [UniteController::class, 'destroy'])->name('unites.destroy');
    });

    Route::prefix('matieres')->group(function() {
        Route::post('/', [MatiereController::class, 'store'])->name('matieres.store');
        Route::get('search/{keyword}', [MatiereController::class, 'search'])->name('matieres.search');
        Route::get('/', [MatiereController::class, 'index'])->name('matieres.index');
        Route::get('/liste', [MatiereController::class, 'list'])->name('matieres.liste');
        Route::get('/{matieres}', [MatiereController::class, 'show'])->name('matieres.show');
        Route::put('/{matieres}', [MatiereController::class, 'update'])->name('matieres.update');
        Route::delete('/{matieres}', [MatiereController::class, 'destroy'])->name('matieres.destroy');
    });
    
});

