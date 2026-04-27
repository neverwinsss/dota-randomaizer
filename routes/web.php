<?php

use App\Http\Controllers\DotaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// Главная страница
Route::get('/', [DotaController::class, 'index'])->name('home');

// Исправленный роут рандома (теперь принимает и GET, и POST)
Route::match(['get', 'post'], '/randomize', [DotaController::class, 'randomize'])->name('randomize');

// Страницы деталей
Route::get('/hero/{id}', [DotaController::class, 'showHero'])->name('hero.show');
Route::get('/item/{id}', [DotaController::class, 'showItem'])->name('item.show');

// Маршруты авторизации (открытые)
Route::get('/login', [LoginController::class, 'showForm'])->name('admin.login.form');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Защищенная админка
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    
    // Управление героями
    Route::post('/hero', [AdminController::class, 'storeHero'])->name('admin.hero.store');
    Route::get('/hero/{id}/edit', [AdminController::class, 'editHero'])->name('admin.hero.edit'); // Страница редактирования
    Route::put('/hero/{id}', [AdminController::class, 'updateHero'])->name('admin.hero.update');   // Сохранение изменений
    Route::delete('/hero/{id}', [AdminController::class, 'deleteHero'])->name('admin.hero.delete');
    
    // Управление предметами
    Route::post('/item', [AdminController::class, 'storeItem'])->name('admin.item.store');
    Route::get('/item/{id}/edit', [AdminController::class, 'editItem'])->name('admin.item.edit'); // Страница редактирования
    Route::put('/item/{id}', [AdminController::class, 'updateItem'])->name('admin.item.update');   // Сохранение изменений
    Route::delete('/item/{id}', [AdminController::class, 'deleteItem'])->name('admin.item.delete');
});