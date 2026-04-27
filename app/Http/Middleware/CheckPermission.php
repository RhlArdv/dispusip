<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        foreach ($permissions as $permission) {
            if (! $request->user()->hasPermission($permission)) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Anda tidak memiliki akses untuk tindakan ini.'
                    ], 403);
                }

                return redirect()
                    ->route('dashboard')
                    ->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        }

        return $next($request);
    }
}
