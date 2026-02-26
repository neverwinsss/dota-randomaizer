@extends('layouts.app')

@section('content')
<div class="details-wrapper">

    <div class="details-card">
        <div class="details-image-box">
            <img src="{{ asset('images/' . $entity->photo) }}">
        </div>

        <div class="details-info-box">
            <span style="color: #dc2626; font-weight: bold;">{{ $type }}</span>
            <h1 style="font-size: 2.5rem; margin: 10px 0;">{{ $entity->name }}</h1>
            
            <div class="info-text">
                {{ $entity->info ?? 'Описание отсутствует' }}
            </div>
        </div>
    </div>
</div>
@endsection