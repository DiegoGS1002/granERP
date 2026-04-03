<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! auth()->attempt($credentials, true)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // Regra: administradores sempre têm acesso livre
        // Regra: usuários inativos não podem fazer login
        if (! auth()->user()->is_admin && ! auth()->user()->is_active) {
            auth()->logout();
            throw ValidationException::withMessages([
                'email' => 'Usuário inativo, entre em contato com o suporte para mais informações.',
            ]);
        }

        $request->session()->regenerate();

        auth()->user()->update([
            'last_login_at' => now(),
        ]);

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

