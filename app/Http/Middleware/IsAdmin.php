<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isAdmin()) {
            if ($request->header('X-Inertia')) {
                return redirect()->route('home')->with('error', 'Unauthorized access.');
            }
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
