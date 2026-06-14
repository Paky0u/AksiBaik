<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Cek apakah user sudah login DAN apakah role-nya sesuai dengan yang diminta rute
        if (!auth()->check() || auth()->user()->role !== $role) {
            // Jika tidak sesuai, tendang ke halaman 403 (Akses Ditolak)
            abort(403, 'Akses Ditolak! Anda tidak memiliki izin untuk halaman ini.');
        }

        return $next($request);
    }
}
