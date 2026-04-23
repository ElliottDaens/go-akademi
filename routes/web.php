<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CrudController as AdminCrudController;
use App\Http\Controllers\Admin\PageEditorController as AdminPageEditorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/presentation', [PageController::class, 'presentation'])->name('presentation');
Route::get('/nos-entrainements', [PageController::class, 'entrainements'])->name('entrainements');
Route::get('/nous-rejoindre', [PageController::class, 'rejoindre'])->name('rejoindre');
Route::get('/actualites', [PageController::class, 'actualites'])->name('actualites');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/inscription', [InscriptionController::class, 'show'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

        Route::get('/pages', [AdminPageEditorController::class, 'index'])->name('pages.index');
        Route::get('/pages/{page}', [AdminPageEditorController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [AdminPageEditorController::class, 'update'])->name('pages.update');

        Route::get('/table/{table}', [AdminCrudController::class, 'index'])->name('table.index');
        Route::get('/table/{table}/create', [AdminCrudController::class, 'create'])->name('table.create');
        Route::post('/table/{table}', [AdminCrudController::class, 'store'])->name('table.store');
        Route::get('/table/{table}/{id}/edit', [AdminCrudController::class, 'edit'])->name('table.edit');
        Route::put('/table/{table}/{id}', [AdminCrudController::class, 'update'])->name('table.update');
        Route::delete('/table/{table}/{id}', [AdminCrudController::class, 'destroy'])->name('table.destroy');
    });
});
