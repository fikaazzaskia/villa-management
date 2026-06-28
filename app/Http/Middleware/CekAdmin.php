<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session('role') != 'admin') {
            return redirect('/dashboard')->with('error', 'Akses ditolak! Khusus admin.');
        }
        return $next($request);
    }
}