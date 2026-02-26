<?php

use App\Http\Controllers\DotaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Главная страница и логика рандома
Route::get('/', [DotaController::class, 'index'])->name('home');
Route::post('/randomize', [DotaController::class, 'randomize'])->name('randomize');

// Страницы деталей (мы их создавали ранее)
Route::get('/hero/{id}', [DotaController::class, 'showHero'])->name('hero.show');
Route::get('/item/{id}', [DotaController::class, 'showItem'])->name('item.show');

// Группа админки
Route::prefix('admin')->group(function () {
    // Главная страница админки
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // Маршруты для ГЕРОЕВ
    Route::post('/hero', [AdminController::class, 'storeHero'])->name('admin.hero.store');
    Route::delete('/hero/{id}', [AdminController::class, 'deleteHero'])->name('admin.hero.delete');
    
    // Маршруты для ПРЕДМЕТОВ (именно здесь была ошибка)
    Route::post('/item', [AdminController::class, 'storeItem'])->name('admin.item.store');
    Route::delete('/item/{id}', [AdminController::class, 'deleteItem'])->name('admin.item.delete');
});

// Маршруты авторизации
Route::get('/login', [LoginController::class, 'showForm'])->name('admin.login.form');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Защищенная админка
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/hero', [AdminController::class, 'storeHero'])->name('admin.hero.store');
    Route::delete('/hero/{id}', [AdminController::class, 'deleteHero'])->name('admin.hero.delete');
    Route::post('/item', [AdminController::class, 'storeItem'])->name('admin.item.store');
    Route::delete('/item/{id}', [AdminController::class, 'deleteItem'])->name('admin.item.delete');
});