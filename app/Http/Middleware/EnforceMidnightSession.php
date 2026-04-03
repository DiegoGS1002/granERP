<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnforceMidnightSession
{
    public function handle(Request $request, Closure $next)
    {
        if (! auth()->check()) {
            return $next($request);
        }

        if (! auth()->user()->last_login_at) {
            return $this->logoutAndRedirect($request);
        }

        $timezone = config('app.timezone');
        $loginDate = auth()->user()->last_login_at->timezone($timezone)->toDateString();
        $currentDate = now()->timezone($timezone)->toDateString();

        if ($loginDate !== $currentDate) {
            return $this->logoutAndRedirect($request);
        }

        return $next($request);
    }

    private function logoutAndRedirect(Request $request)
    {
        auth()->guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('error', 'Sua sessao expirou apos a meia-noite. Entre novamente.');
    }
}

