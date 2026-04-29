<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Dota 2 Randomizer</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="site-header">
        <a href="/" class="logo">Dota<span>Random</span></a>
        <a href="{{ route('admin.index') }}" class="admin-link">Админ-панель</a>
    </header>

    <main class="main-content">
        @yield('content')
    </main>

<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-info">
            <a href="{{ route('home') }}" class="logo">DOTA<span>PICKER</span></a>
            <p>&copy; 2026 Dota 2 Hero Picker</p>
        </div>

        <div class="footer-contacts">
            <span class="footer-label">Связь с нами</span>
            <div class="footer-nav">
                <a href="https://t.me/+yvmhamP5ANEyNmE6" target="_blank" class="footer-link">
                    <span class="footer-icon">📢</span> ТГ-канал
                </a>
                <a href="https://t.me/dota-supporter" target="_blank" class="footer-link">
                    <span class="footer-icon">✉️</span> Поддержка / Идеи
                </a>
            </div>
        </div>
    </div>
</footer>



</body>
</html>