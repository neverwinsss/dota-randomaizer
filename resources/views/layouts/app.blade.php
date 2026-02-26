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
        <p>&copy; 2026 Dota 2 Hero Picker</p>
    </footer>
</body>
</html>