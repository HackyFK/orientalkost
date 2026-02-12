<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login'); // ganti dengan route login kamu
            }

            // Pastikan user punya role admin
            if (Auth::user()->role !== 'admin') {
                // abort(403, 'Unauthorized'); // bisa juga redirect ke halaman lain
                return redirect()->route('user.beranda'); // ganti dengan route login kamu
        }

        return $next($request);
    }
}
