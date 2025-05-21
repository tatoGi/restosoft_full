<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    public function handle($request, Closure $next)
    {

            if (! in_array($request->segment(1), config('translatable.locales'))) {

                $fallback = session('locale') ?: config('app.fallback_locale');

                return redirect()->to('/'.$fallback);
            }

            session(['locale' => $request->segment(1)]);
            app()->setLocale($request->segment(1));

            $request->route()->forgetParameter('locale');

        return $next($request);
    }
}
