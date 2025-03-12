<?php

use App\Http\Controllers\dashboard\Library;
use App\Http\Controllers\Library\AuteurController;
use App\Http\Controllers\Library\CollectionController;
use App\Http\Controllers\Library\EditeurController;
use App\Http\Controllers\Library\EditionController;
use App\Http\Controllers\Library\GenreLivreController;
use App\Http\Controllers\Library\SerieController;
use App\Http\Controllers\Library\TagController;
use App\Http\Controllers\Library\TomeController;
use App\Http\Controllers\Library\TypeLivreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ACCUEIL
Route::get('/', function () {
    return view('welcome');
});

// PERSO
Route::middleware('auth')->group(function () {
    //Route::get('/dashboard-library', [Library::class, 'index'])->name('dashboard-library');

    //Auteur
    Route::get('/auteur/create', [AuteurController::class, 'create'])->name('auteur.create');
    Route::post('/auteur/store', [AuteurController::class, 'store'])->name('auteur.store');

    //Collections
    Route::post('/collection/add', [CollectionController::class, 'addTome'])->name('collection.addTome');
    Route::post('/collection/remove', [CollectionController::class, 'removeTome'])->name('collection.removeTome');
    Route::get('/collection/recherche', [CollectionController::class, 'recherche'])->name('collection.recherche');
    Route::get('/collection', [CollectionController::class, 'index'])->name('collection');

    //Editeur
    Route::get('/editeur/create', [EditeurController::class, 'create'])->name('editeur.create');
    Route::post('/editeur/store', [EditeurController::class, 'store'])->name('editeur.store');

    //Edition
    Route::get('/edition/create', [EditionController::class, 'create'])->name('edition.create');
    Route::post('/edition/store', [EditionController::class, 'store'])->name('edition.store');

    //GenreLivre
    Route::get('/genreLivre/create', [GenreLivreController::class, 'create'])->name('genreLivre.create');
    Route::post('/genreLivre/store', [GenreLivreController::class, 'store'])->name('genreLivre.store');

    //Séries
    Route::get('/series/recherche', [SerieController::class, 'recherche'])->name('serie.recherche');
    Route::get('/series/create', [SerieController::class, 'create'])->name('serie.create');
    Route::post('/series/store', [SerieController::class, 'store'])->name('serie.store');
    Route::get('/series/{serie}', [SerieController::class, 'show'])->name('serie.show');
    Route::get('/series', [SerieController::class, 'index'])->name('serie.index');

    //Tag
    Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::post('/tag/store', [TagController::class, 'store'])->name('tag.store');

    //Tome
    Route::get('/tomes/create', [TomeController::class, 'create'])->name('tome.create');
    Route::get('/tomes/scan', [TomeController::class, 'scan'])->name('tome.scan');
    Route::post('/tomes/store', [TomeController::class, 'store'])->name('tome.store');

    //TypeLivre
    Route::get('/typeLivre/create', [TypeLivreController::class, 'create'])->name('typeLivre.create');
    Route::post('/typeLivre/store', [TypeLivreController::class, 'store'])->name('typeLivre.store');
});


// BREEZE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');*/
Route::get('/dashboard', function () {
    //return redirect('/dashboard-library');
    return redirect('/collection');
})->name('dashboard');

require __DIR__.'/auth.php';
