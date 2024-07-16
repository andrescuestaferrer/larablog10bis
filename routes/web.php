<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\Localization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('lang/change', [Localization::class, 'change'])->name('changeLang');

Route::get('language/{locale?}', function ($locale = null) {

    // trying to read an optional locale GET parameter and set the current locale accordingly
    if (isset($locale) && in_array($locale, config('app.available_locales'))) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
    }
    
    return redirect()->back();
});



