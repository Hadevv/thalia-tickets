<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('AdminMiddleware: Checking if user is admin');

        // Vérifier si la route est "/admin"
        if ($request->is('admin') || $request->is('admin/*')) {
            Log::info('AdminMiddleware: Request is admin route');

            if (!Auth::check()) {
                Log::info('AdminMiddleware: User is not authenticated');
                return response('Unauthorized.', 401);
            }

            if (!Auth::user()->isAdmin()) {
                Log::info('AdminMiddleware: User is not an admin');
                return response('Unauthorized.', 401);
            }
        }

        Log::info('AdminMiddleware: User is admin. Proceeding with request.');
        return $next($request);
    }
}
