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
     * Форма редактирования героя.
     */
    public function editHero($id)
    {
        $hero = Hero::findOrFail($id);
        return view('admin.edit_hero', compact('hero'));
    }

    /**
     * Обновление данных героя.
     */
    public function updateHero(Request $request, $id)
    {
        $hero = Hero::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'info' => 'nullable|string',
        ]);

        $hero->name = $request->name;
        $hero->info = $request->info;

        if ($request->hasFile('photo')) {
            // Удаляем старое фото, если оно существует
            if (File::exists(public_path('images/' . $hero->photo))) {
                File::delete(public_path('images/' . $hero->photo));
            }
            
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/heroes'), $filename);
            $hero->photo = 'heroes/' . $filename;
        }

        $hero->save();
        return redirect()->route('admin.index')->with('success', 'Герой обновлен!');
    }

    /**
     * Удаление героя.
     */
    public function deleteHero($id)
    {
        $hero = Hero::findOrFail($id);
        
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
     * Форма редактирования предмета.
     */
    public function editItem($id)
    {
        $item = Item::findOrFail($id);
        return view('admin.edit_item', compact('item'));
    }

    /**
     * Обновление данных предмета.
     */
    public function updateItem(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'info' => 'nullable|string',
        ]);

        $item->name = $request->name;
        $item->info = $request->info;

        if ($request->hasFile('photo')) {
            // Удаляем старое фото
            if (File::exists(public_path('images/' . $item->photo))) {
                File::delete(public_path('images/' . $item->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/items'), $filename);
            $item->photo = 'items/' . $filename;
        }

        $item->save();
        return redirect()->route('admin.index')->with('success', 'Предмет обновлен!');
    }

    /**
     * Удаление предмета.
     */
    public function deleteItem($id)
    {
        $item = Item::findOrFail($id);

        $imagePath = public_path('images/' . $item->photo);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $item->delete();
        return back()->with('success', 'Предмет удален.');
    }
}