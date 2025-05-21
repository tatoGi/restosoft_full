<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $fallback = session('locale') ?: config('app.fallback_locale');

        if (! auth()->user()->isType('admin')) {

            return redirect()->to('/'.$fallback.'/admin');
        }

        return $next($request);
    }
}
