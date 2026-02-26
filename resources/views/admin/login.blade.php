@extends('layouts.app')

@section('content')
<div class="login-container">
    <div style="text-align: center; margin-bottom: 10px;">
        <span style="color: #f57d31; font-size: 40px;">🛡️</span>
    </div>
    <h2 class="login-title">Access Control</h2>
    
    @if(session('error'))
        <div class="login-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Identification</label>
            <input type="text" name="login" class="login-input" placeholder="LOGIN" required autocomplete="off">
        </div>
        
        <div class="form-group">
            <label>Security Key</label>
            <input type="password" name="password" class="login-input" placeholder="PASSWORD" required>
        </div>

        <button type="submit" class="login-button">
            Authenticate
        </button>
    </form>
</div>
@endsection