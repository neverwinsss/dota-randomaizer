<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showForm() { return view('admin.login'); }

    public function login(Request $request) {
        if ($request->login === 'admin' && $request->password === '123') {
            $request->session()->put('admin_logged_in', true);
            return redirect()->route('admin.index');
        }
        return back()->with('error', 'Неверный логин или пароль');
    }

    public function logout(Request $request) {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('home');
    }
}