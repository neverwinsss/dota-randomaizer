@extends('layouts.app')

@section('content')
<div class="container-center">
    <form action="{{ route('randomize') }}" method="POST">
        @csrf
        <button type="submit" class="btn-random">Подобрать сборку</button>
    </form>

    <div class="hero-display">
        <a href="{{ $hero ? route('hero.show', $hero->id) : '#' }}" class="hero-card-main">
            @if($hero)
                <img src="{{ asset('images/' . $hero->photo) }}">
                <div class="hero-name-overlay">{{ $hero->name }}</div>
            @else
                <span class="placeholder-icon">?</span>
            @endif
        </a>

        <div class="items-grid">
            @for($i = 0; $i < 6; $i++)
                <a href="{{ isset($items[$i]) ? route('item.show', $items[$i]->id) : '#' }}" class="item-slot">
                    @if(isset($items[$i]))
                        <img src="{{ asset('images/' . $items[$i]->photo) }}" title="{{ $items[$i]->name }}">
                    @else
                        <span class="placeholder-item">ITEM</span>.
                    @endif
                </a>
            @endfor
        </div>
    </div>
</div>
@endsection