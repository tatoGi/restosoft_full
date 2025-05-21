<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Superuser
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
            $fallback = session('locale') ?: config('app.fallback_locale');

            if (! auth()->user()->isType('superuser')) {

                return redirect()->to('/'.$fallback.'/admin');
            }

        return $next($request);
    }
}
