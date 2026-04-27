@extends('layouts.app')

@section('content')
<div class="admin-wrapper">
    <h1 class="admin-title">Управление базой данных</h1>

    <section class="admin-section">
        <div class="section-header">
            <h2 style="color: #ef4444;">🛡️ ГЕРОИ</h2>
        </div>

        <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="admin-form-box">
            @csrf
            <div class="admin-input-group">
                <label>Имя героя</label>
                <input type="text" name="name" class="admin-input" required placeholder="Напр: Axe">
            </div>
            <div class="admin-input-group">
                <label>Информация</label>
                <input type="text" name="info" class="admin-input" placeholder="Сила / Ближний бой">
            </div>
            <div class="admin-input-group">
                <label>Изображение</label>
                <input type="file" name="photo" class="admin-input" required>
            </div>
            <button type="submit" class="btn-add">ДОБАВИТЬ</button>
        </form>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Имя</th>
                    <th>Описание</th>
                    <th style="text-align: right;">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach($heroes as $hero)
                <tr>
                    <td><img src="{{ asset('images/' . $hero->photo) }}" style="width: 50px; height: 30px; object-fit: cover; border-radius: 3px;"></td>
                    <td>{{ $hero->name }}</td>
                    <td class="admin-description">{{ $hero->info }}</td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn-edit" style="background: #eab308; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px;">Редакт.</a>
                            
                            <form action="{{ route('admin.hero.delete', $hero->id) }}" method="POST" onsubmit="return confirm('Удалить героя?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <hr class="admin-divider">

    <section class="admin-section">
        <div class="section-header">
            <h2 style="color: #3b82f6;">⚔️ ПРЕДМЕТЫ</h2>
        </div>

        <form action="{{ route('admin.item.store') }}" method="POST" enctype="multipart/form-data" class="admin-form-box">
            @csrf
            <div class="admin-input-group">
                <label>Название предмета</label>
                <input type="text" name="name" class="admin-input" required placeholder="Напр: Blink Dagger">
            </div>
            <div class="admin-input-group">
                <label>Информация</label>
                <input type="text" name="info" class="admin-input" placeholder="Цена: 2250">
            </div>
            <div class="admin-input-group">
                <label>Изображение</label>
                <input type="file" name="photo" class="admin-input" required>
            </div>
            <button type="submit" class="btn-add">ДОБАВИТЬ</button>
        </form>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th style="text-align: right;">Действие</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td><img src="{{ asset('images/' . $item->photo) }}" style="width: 40px; height: 30px; object-fit: cover; border-radius: 3px;"></td>
                    <td>{{ $item->name }}</td>
                    <td class="admin-description">{{ $item->info }}</td>
                    <td style="text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.item.edit', $item->id) }}" class="btn-edit" style="background: #eab308; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px;">Редакт.</a>
                            
                            <form action="{{ route('admin.item.delete', $item->id) }}" method="POST" onsubmit="return confirm('Удалить предмет?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</div>
@endsection