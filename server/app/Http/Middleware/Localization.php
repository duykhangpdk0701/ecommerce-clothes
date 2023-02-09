<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Locale
     *
     * @var string
     */
    public $locale;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentLocale = App::currentLocale();
        $isSetLocale = session()->has('locale');
        $locale = session()->get('locale');

        /**
         * If Accept-Language header found then set it to the default locale
         */
        if ($request->hasHeader('Accept-Language') && $request->wantsJson()) {
            App::setLocale($request->header("Accept-Language"));
        }

        if ($isSetLocale && $locale != $currentLocale) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
