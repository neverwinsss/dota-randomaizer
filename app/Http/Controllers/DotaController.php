<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use Illuminate\Http\Request;

class DotaController extends Controller
{
    public function index() {
        return view('welcome', [
            'hero' => null,
            'items' => collect()
        ]);
    }

    public function randomize() {
        // Получаем одного случайного героя
        $hero = Hero::inRandomOrder()->first();
        
        // Берем 6 случайных уникальных предметов
        $items = Item::inRandomOrder()->limit(6)->get();

        return view('welcome', compact('hero', 'items'));
    }

    public function showHero($id) {
        $hero = Hero::findOrFail($id);
        return view('details', ['entity' => $hero, 'type' => 'Герой']);
    }

    public function showItem($id) {
        $item = Item::findOrFail($id);
        return view('details', ['entity' => $item, 'type' => 'Предмет']);
    }
}