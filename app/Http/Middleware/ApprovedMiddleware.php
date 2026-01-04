<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApprovedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) { 
        return redirect()->route('login'); 
    }

    if ($request->user()->role_id != 1 && $request->user()->status != 'approved') {
        abort(403, 'Akses ditolak, user belum di-approve');
    }


        return $next($request);
    }
}
