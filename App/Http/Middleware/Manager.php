<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $fallback = session('locale') ?: config('app.fallback_locale');

        if (! auth()->user()->isType('manager')) {

            return redirect()->to('/'.$fallback);
        }

        return $next($request);
    }
}
