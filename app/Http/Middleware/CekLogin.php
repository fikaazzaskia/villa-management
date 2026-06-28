<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('username')) {
            return redirect('/')->with('error', 'Silahkan login terlebih dahulu!');
        }
        return $next($request);
    }
}