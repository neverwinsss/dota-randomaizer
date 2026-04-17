<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Добавь это для проверки

class DotaController extends Controller
{
    public function index() {
        return view('welcome', [
            'hero' => null,
            'items' => collect()
        ]);
    }

    public function randomize() {
        // --- ВРЕМЕННЫЙ ТЕСТ (Удали после исправления) ---
        if (app()->environment('production')) {
            $config = config('database.connections.mysql');
            // Если ты увидишь тут 127.0.0.1 — кеш не сброшен.
            // Если порт не 3306 — ошибка в переменных Railway.
            dd([
                'Host из конфига' => $config['host'],
                'Port из конфига' => $config['port'],
                'Database' => $config['database'],
                'Environment Host' => env('DB_HOST'),
            ]);
        }
        // -----------------------------------------------

        $hero = Hero::inRandomOrder()->first();
        $items = Item::inRandomOrder()->limit(6)->get();

        return view('welcome', compact('hero', 'items'));
    }

    public function showHero($id) {
        $hero = \App\Models\Hero::findOrFail($id);
        return view('details', ['entity' => $hero, 'type' => 'Герой']);
    }

    public function showItem($id) {
        $item = \App\Models\Item::findOrFail($id);
        return view('details', ['entity' => $item, 'type' => 'Предмет']);
    }
}