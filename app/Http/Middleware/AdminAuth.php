<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем, авторизован ли пользователь в сессии
        if ($request->session()->get('admin_logged_in')) {
            return $next($request);
        }

        return redirect()->route('admin.login.form');
    }
}