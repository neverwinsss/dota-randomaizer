@extends('layouts.app')

@section('content')
<div class="admin-wrapper">
    <h1>Редактирование предмета: {{ $item->name }}</h1>

    <form action="{{ route('admin.item.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="admin-form-box">
        @csrf
        @method('PUT')
        
        <div class="admin-input-group">
            <label>Название предмета</label>
            <input type="text" name="name" class="admin-input" value="{{ $item->name }}" required>
        </div>

        <div class="admin-input-group">
            <label>Информация</label>
            <input type="text" name="info" class="admin-input" value="{{ $item->info }}">
        </div>

        <div class="admin-input-group">
            <label>Текущее фото</label><br>
            <img src="{{ asset('images/' . $item->photo) }}" width="100"><br>
            <label>Заменить фото (оставьте пустым, если не хотите менять)</label>
            <input type="file" name="photo" class="admin-input">
        </div>

        <button type="submit" class="btn-add">ОБНОВИТЬ</button>
        <a href="{{ route('admin.index') }}" style="color: gray; margin-left: 20px;">Отмена</a>
    </form>
</div>
@endsection