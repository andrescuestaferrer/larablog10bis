<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
        return $next($request);
    }

    public function change(Request $request): RedirectResponse
    {
        $new_lang = $request->lang; 
        if (isset($new_lang) && in_array($new_lang, config('app.available_locales'))) {
            App::setLocale($new_lang);
            session()->put('locale', $new_lang);
        }
  
        return redirect()->back();
    }
}
