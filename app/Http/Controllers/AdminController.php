<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Отображение главной страницы админки со списками всех героев и предметов.
     */
    public function index()
{
    // Сортируем по ID, так как он точно есть в БД
    $heroes = Hero::orderBy('id', 'desc')->get();
    $items = Item::orderBy('id', 'desc')->get();
    
    return view('admin.index', compact('heroes', 'items'));
}

    /**
     * Сохранение нового героя.
     */
    public function storeHero(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'info' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Сохраняем физически в public/images/heroes
            $file->move(public_path('images/heroes'), $filename);
            $path = 'heroes/' . $filename;
        }

        Hero::create([
            'name' => $request->name,
            'info' => $request->info,
            'photo' => $path ?? 'placeholder.png'
        ]);

        return back()->with('success', 'Герой успешно добавлен!');
    }

    /**
     * Удаление героя.
     */
    public function deleteHero($id)
    {
        $hero = Hero::findOrFail($id);
        
        // Удаляем файл картинки, если он существует, чтобы не засорять память
        $imagePath = public_path('images/' . $hero->photo);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $hero->delete();
        return back()->with('success', 'Герой удален.');
    }

    /**
     * Сохранение нового предмета.
     */
    public function storeItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'info' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Сохраняем физически в public/images/items
            $file->move(public_path('images/items'), $filename);
            $path = 'items/' . $filename;
        }

        Item::create([
            'name' => $request->name,
            'info' => $request->info,
            'photo' => $path ?? 'placeholder.png'
        ]);

        return back()->with('success', 'Предмет успешно добавлен!');
    }

    /**
     * Удаление предмета.
     */
    public function deleteItem($id)
    {
        $item = Item::findOrFail($id);

        // Удаляем файл картинки
        $imagePath = public_path('images/' . $item->photo);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $item->delete();
        return back()->with('success', 'Предмет удален.');
    }
}