<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Ownership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $discussion = $request->route('discussion');
        $user = Auth::user();

        if ($user->is_admin || $user->id === $discussion->user_id) {
            return $next($request);
        }

        return redirect('/')->with('error', 'You are not allowed to access this page.');
    }
}
