<?php

use App\Models\Tache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    $taches = Tache::paginate(10);
    return view('welcome', compact('taches'));
})->name('welcome');


// Routes pour les tâches
Route::resource('taches', TacheController::class);

// Routes pour les catégories
Route::resource('categories', CategorieController::class);