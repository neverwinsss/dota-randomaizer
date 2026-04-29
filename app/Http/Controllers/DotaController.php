<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use Illuminate\Http\Request; // Это должно быть здесь

class DotaController extends Controller
{
    public function index() {
        return view('welcome', [
            'hero' => null,
            'items' => collect()
        ]);
    }

    
    public function randomize(Request $request) {
        // 1. Берем ID героя, который выпал в прошлый раз (из сессии)
        $lastHeroId = session('last_hero_id');

        // 2. Получаем случайного героя, исключая предыдущего
        $hero = Hero::where('id', '!=', $lastHeroId)
                    ->inRandomOrder()
                    ->first();
        
        // 3. Запоминаем ID текущего героя для следующего клика
        session(['last_hero_id' => $hero->id]);
        
        // 4. Берем 6 случайных уникальных предметов (база сама исключит повторы)
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